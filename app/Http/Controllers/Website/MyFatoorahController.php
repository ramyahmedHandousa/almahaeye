<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Order;
use AymanElmalah\MyFatoorah\Facades\MyFatoorah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MyFatoorahController extends Controller
{

    public $baseUrl;

    public function __construct()
    {
        $this->middleware('auth');

        $this->baseUrl = env('APP_URL');
    }

    public function index(Request $request) {

        $myIds =  json_encode($request->ids);

        $myIds = str_replace("[", "", $myIds);
        $myIds = str_replace("]", "", $myIds);

        $callBackUrl =   $this->baseUrl. '/my-payment/callback?ids=' .$myIds;
        $callBackUrl = str_replace('"', "",$callBackUrl);

        $errorUrl =   $this->baseUrl. '/my-payment/error?ids=' .$myIds;
        $errorUrl = str_replace('"', "",$errorUrl);

        $data = [
            'CustomerName'          => auth()->user()->name,
            'NotificationOption'    => 'all',
            'CustomerMobile'        => auth()->user()->phone,
            'DisplayCurrencyIso'    => 'SAR',
            'CustomerEmail'         => auth()->user()->email,
            'InvoiceValue'          => $request->total,
            'Language'              => 'en',
            'CallBackUrl'           => $callBackUrl,
            'ErrorUrl'              => $errorUrl
        ];

        try {

            $myfatoorah = MyFatoorah::createInvoice($data);

            if ($myfatoorah['Data']??['InvoiceURL'] ){

                return redirect()->away($myfatoorah['Data']['InvoiceURL']);

            }else{

                session()->flash('my-errors','للأسف يرجي التاكد من بيانات الدفع الخاصة بك..');

                return redirect('/');
            }

        }catch (\Exception $exception){

            session()->flash('my-errors','للأسف يرجي التاكد من بيانات الدفع..');

            return redirect('/');
        }
    }

    public function callback(Request $request) {

        $myfatoorah = MyFatoorah::payment($request->paymentId);

        if (!$myfatoorah->isSuccess()){

            session()->flash('my-errors','للأسف يرجي التاكد من بيانات الدفع.!!.');

            return redirect('/');
        }


        $myData = $myfatoorah->get();

        $ids = explode(',',$request->ids);

        $orders = Order::whereIn('id',$ids)->get();

        $data = [
            'status'    => 'pending',
            'payment'    => 'online',
            'payment_id' => $request->paymentId,
            'payment_method' => $myData['Data']['InvoiceTransactions'][0]['PaymentGateway'],
        ];

        $orders->each->update($data);

        Session::forget('cart');

        session()->flash('success','تم  طلبك بنجاح');

        return redirect()->route('orders.index');
    }

    public function error(Request $request) {

        $ids = explode(',',$request->ids);

        $orders = Order::whereIn('id',$ids)->get(['id']);

        $orders->each->delete();

        session()->flash('my-errors','للأسف يوجد خطأ في  بيانات الدفع..');

        return redirect('/');
    }


}
