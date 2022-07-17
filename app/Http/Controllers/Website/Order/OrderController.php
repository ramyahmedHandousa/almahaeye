<?php

namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Order\OrderStoreValid;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Shipping;
use App\Support\Aramex\API\Classes\Address;
use App\Support\Aramex\API\Classes\Contact;
use App\Support\Aramex\API\Classes\LabelInfo;
use App\Support\Aramex\API\Classes\Pickup;
use App\Support\Aramex\API\Classes\PickupItem;
use App\Support\Aramex\API\Classes\Weight;
use App\Support\Aramex\Aramex;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use JetBrains\PhpStorm\ArrayShape;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->type != 'vendor'){

            $ordersQuery =  $user->orders()->latest();
        }else{
            $ordersQuery = $user->order_vendors();
        }


        $orders = $ordersQuery->withCount('orderItems')->get();

        $pendingOrders = $orders->where('status','pending')->values();

        $acceptedOrders = $orders->where('status','accepted')->values();

        $finishOrders = $orders->where('status','finish')->values();

        $refuseOrders = $orders->whereIn('status',['refuse_by_user','refuse_by_vendor'])->values();

        return view('website.orders.index',[
            'pendingOrders'  => $pendingOrders ,
            'acceptedOrders' => $acceptedOrders,
            'finishOrders'  => $finishOrders,
            'refuseOrders'  => $refuseOrders,
        ]);
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');

        return view('website.orders.show',compact('order'));
    }


    public function store(OrderStoreValid $request)
    {
        $cart  = session()->get('cart');

        DB::beginTransaction();

        try {

            $cartProducts = collect($cart)->groupBy('user_id');

            $orderDataFilter  = [];

                foreach ($cartProducts as $vendorId =>  $cartProduct){

                    $order = $this->createOrder($cartProduct,$vendorId,$request);

                    $orderDataFilter[$vendorId]['id'] = $order->id;
                    $orderDataFilter[$vendorId]['total_price'] = $order->total_price;

                    OrderDetails::insert($this->transformProducts($cartProduct,$order));

                    if ($request->payment_method = 'cash'){
                        $guid = $this->getGUID($order);
                        $this->makeShipping($guid,$order);
                    }
                }

                    if ($request->payment_method != 'online'){
                        Session::forget('cart');
                    }

            DB::commit();

            $orderIds = collect($orderDataFilter)->pluck('id');
            $totalOrderPrice = collect($orderDataFilter)->sum('total_price');

            return response()->json([
                'status' => 200,
                'data' => [
                    'url'   => $request->payment_method != 'online' ? URL::to('orders') : URL::to('/payment?ids='. json_encode($orderIds) .'&total=' . $totalOrderPrice),
                    'empty' => $request->payment_method != 'online',
                    'orderData' => $orderDataFilter
                ]
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            Log::info(print_r($e->getMessage(),true));

            return  response()->json(['status' => 500]);
        }
    }

    private function createOrder($cart,$vendorId,$request)
    {
        $shipping = Shipping::find($request->shipping_id);

        $promoCode = $request->coupon ? PromoCode::firstWhere('code',$request->coupon) : null;

        $percentage = Setting::getBody('percentage');

        $calculatorCart  = $this->calculatorTotalCart($cart,$promoCode,$percentage);

        return auth()->user()->orders()->create([
            'vendor_id'             => $vendorId,
            'address_id'            => $request->address_id,
            'shipping_id'           => $shipping?->id,
            'shipping_price'        => $shipping?->price,
            'shipping_city_name'    => $request->shipping_city_name,
            'promo_code_id'         => $promoCode?->id,
            'promo_discount'        => $calculatorCart['discount'],
            'tax'                   => $percentage,
            'price'                 => $calculatorCart['cartPrice'],
            'total_price'           => $calculatorCart['totalPrice'] + $shipping?->price,
            'status'                => $request->payment_method != 'online' ? 'pending' : 'cart',
            'payment'               => $request->payment ? : 'cash'
        ]);

    }



    #[ArrayShape(['cartPrice' => "mixed", 'discount' => "float|int", 'totalPrice' => "float|int|mixed"])]
    private function calculatorTotalCart($cart, $promoCode, $percentage): array
    {
        $totalCart = collect( $cart)->sum(function ($product) {
            return ($product['discount'] ?: $product['price'] ) * $product['quantity'];
        });

        $discount = $promoCode ? round($totalCart * $promoCode?->percentage /100,2) : 0;

        $totalAfterDisCount = $totalCart - $discount;

        $totalAfterDisCount +=  round(($totalAfterDisCount) * $percentage / 100,2);

        return ['cartPrice' => $totalCart,'discount' => $discount , 'totalPrice' => $totalAfterDisCount];
    }

    private function transformProducts($cart, $order)
    {
        return collect($cart)->transform(function ($product) use ($order){
           return [
               'order_id'           => $order->id,
               'user_id'            => $product['user_id'],
               'product_id'         => $product['id'],
               'quantity'           => $product['quantity'],
               'price'              => $product['price'],
               'price_discount'     => $product['discount'],
               'frame_color_id'     => $product['frame_color_id'],
           ];
        })->toArray();

    }


    private function getGUID($order)
    {
        $source = (new Address())->setLine1('SA Dist. Name')->setCity($order->shipping_city_name)->setCountryCode('SA');

        $contact = (new Contact())->setPhoneNumber1('0504966997')
            ->setCellPhone('0504966997')
            ->setPersonName(env('ARAMEX_USERNAME'))
            ->setCompanyName(env('ARAMEX_USERNAME'))
            ->setEmailAddress(env('ARAMEX_USERNAME'));

        $wight = (new Weight())->setUnit('kg')->setValue(20.0);

        $pickupItem = (new PickupItem())
            ->setProductGroup('DOM')
            ->setProductType('CDS')
            ->setPayment('3')
            ->setNumberOfShipments(1)
            ->setShipmentWeight($wight)
            ->setNumberOfPieces(1);

        $today = new Carbon();
        $timeNow = Carbon::now()->between('09:00:00','16:00:00');
        $readyTime =   Carbon::createFromFormat('H:i:s', '12:00:00');
        $timeClose =   Carbon::createFromFormat('H:i:s', '16:00:00');

        if ($timeNow){
            $readyTime = Carbon::now()->addHours(2)->timestamp;
            $timeClose = Carbon::now()->addHours(2)->timestamp;
        }else{

            if (in_array($today->dayOfWeek,[5,6])){
                $readyTime =  $readyTime->addDay()->timestamp;
                $timeClose =  $timeClose->addDay()->timestamp;
            }else{
                $readyTime =  $readyTime->timestamp;
                $timeClose =  $timeClose->timestamp;
            }
        }


        $pickup = (new Pickup())
            ->setPickupAddress($source)
            ->setPickupContact($contact)
            ->setPickupLocation('Reception')
            ->setPickupDate($readyTime)
            ->setReadyTime($readyTime)
            ->setLastPickupTime($timeClose)
            ->setClosingTime($timeClose)
            ->setComments('pls be carefuller')
            ->setStatus('Ready')
            ->setReference1($order->id)
            ->addPickupItem($pickupItem);

        $labelInfo = (new LabelInfo())->setReportId(9201)->setReportType('URL');

        $createPickup = Aramex::createPickup()->setLabelInfo($labelInfo)->setPickup($pickup)->run();

        Log::info(print_r($createPickup,true));
        return  $createPickup->getPrecessedPickup()->getGUID();
    }

    private function makeShipping($guid,$order)
    {
        $soapClient = new \SoapClient('https://almahaeye.com/shippingW.wsdl');
        $params = array(
            'Shipments' => array(
                'Shipment' => array(
                    'Shipper'	=> array(
                        'Reference1' 	=> $order->id,
                        'Reference2' 	=> $order->id,
                        'AccountNumber' => '60535771',
                        'PartyAddress'	=> array(
                            'Line1'					=> 'Dammam St',
                            'Line2' 				=> '',
                            'Line3' 				=> '',
                            'City'					=> 'Dammam',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),
                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> 'alsha3er',
                            'Title'					=> '',
                            'CompanyName'			=> 'alsha3er',
                            'PhoneNumber1'			=> '5555555',
                            'PhoneNumber1Ext'		=> '125',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '07777777', // هو هو phoneNumber1
                            'EmailAddress'			=> 'alsha3er12@gmail.com',
                            'Type'					=> ''
                        ),
                    ),

                    'Consignee'	=> array(
                        'Reference1'	=> $order->id,
                        'Reference2'	=> $order->id,
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> $order->address?->address ?? '--------',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> $order->shipping_city_name,
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),

                        'Contact'		=> array( //الشخص المستلم
                            'Department'			=> '',
                            'PersonName'			=> $order->user?->name,
                            'Title'					=> '',
                            'CompanyName'			=> $order->user?->name,
                            'PhoneNumber1'			=> $order->user?->phone,
                            'PhoneNumber1Ext'		=> '155',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> $order->user?->phone,
                            'EmailAddress'			=> $order->user?->email,
                            'Type'					=> ''
                        ),
                    ),
                    'ThirdParty' => array(
                        'Reference1' 	=> '',
                        'Reference2' 	=> '',
                        'AccountNumber' => '60535771',
                        'PartyAddress'	=> array(
                            'Line1'					=> 'Dammam St',
                            'Line2' 				=> '',
                            'Line3' 				=> '',
                            'City'					=> 'Dammam',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),
                        'Contact'		=> array(
                            'Department'			=> '',
                            'PersonName'			=> 'alsha3er',
                            'Title'					=> '',
                            'CompanyName'			=> 'alsha3er',
                            'PhoneNumber1'			=> '0504966997',
                            'PhoneNumber1Ext'		=> '',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '0504966997',
                            'EmailAddress'			=> 'alsha3er12@gmail.com',
                            'Type'					=> ''
                        ),
                    ),
                    'Reference1' 				=> $order->id, // order number
                    'Reference2' 				=> '',
                    'Reference3' 				=> '',
                    'ForeignHAWB'				=> '',
                    'TransportType'				=> 0,
                    'ShippingDateTime' 			=> time(),
                    'DueDate'					=> time(),
                    'PickupLocation'			=> 'Reception',
                    'PickupGUID'				=> $guid,
                    'Comments'					=> ' ',
                    'AccountingInstrcutions' 	=> '',
                    'OperationsInstructions'	=> '',
                    'Details' => array(
                        'Dimensions' => array(
                            'Length'				=> 10,
                            'Width'					=> 10,
                            'Height'				=> 10,
                            'Unit'					=> 'cm',
                        ),
                        'ActualWeight' => array(
                            'Value'					=> 0.5,
                            'Unit'					=> 'Kg'
                        ),

                        'ProductGroup' 			=> 'DOM',
                        'ProductType'			=> 'CDS',
                        'PaymentType'			=> '3',
                        'PaymentOptions' 		=> '',
                        'Services'				=> '',
                        'NumberOfPieces'		=> 1,
                        'DescriptionOfGoods' 	=> 'Docs',
                        'GoodsOriginCountry' 	=> 'SA',

                        'CashOnDeliveryAmount' 	=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'InsuranceAmount'		=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CollectAmount'			=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CashAdditionalAmount'	=> array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'CashAdditionalAmountDescription' => '',

                        'CustomsValueAmount' => array(
                            'Value'					=> 0,
                            'CurrencyCode'			=> ''
                        ),

                        'Items' 				=> array(

                        )
                    ),
                ),
            ),

            'ClientInfo'  			=> array(
                'AccountCountryCode'	=> 'SA',
                'AccountEntity'		 	=> 'DHA',
                'AccountNumber'		 	=> '60535771',
                'AccountPin'		 	=> '543543',
                'UserName'			 	=> 'alsha3er12@gmail.com',
                'Password'			 	=> 'A@s8177460',
                'Version'			 	=> '1.0'
            ),

            'Transaction' 			=> array(
                'Reference1'			=> '001',
                'Reference2'			=> '',
                'Reference3'			=> '',
                'Reference4'			=> '',
                'Reference5'			=> '',
            ),
            'LabelInfo'				=> array(
                'ReportID' 				=> 9201,
                'ReportType'			=> 'URL',
            ),
        );

        $params['Shipments']['Shipment']['Details']['Items'][] = array(
            'PackageType' 	=> 'Box',
            'Quantity'		=> 1,
            'Weight'		=> array(
                'Value'		=> 0.5,
                'Unit'		=> 'Kg',
            ),
            'Comments'		=> 'Docs',
            'Reference'		=> ''
        );

        try {
            $auth_call = $soapClient->CreateShipments($params);

        } catch (\SoapFault $fault) {

            return  $fault->faultstring;
        }

    }
}
