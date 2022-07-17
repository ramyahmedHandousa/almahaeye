<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Sms;
use App\Support\Aramex\API\Classes\Address;
use App\Support\Aramex\API\Classes\Contact;
use App\Support\Aramex\API\Classes\LabelInfo;
use App\Support\Aramex\API\Classes\Party;
use App\Support\Aramex\API\Classes\Pickup;
use App\Support\Aramex\API\Classes\PickupItem;
use App\Support\Aramex\API\Classes\Shipment;
use App\Support\Aramex\API\Classes\ShipmentDetails;
use App\Support\Aramex\API\Classes\Weight;
use App\Support\Aramex\Aramex;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

//use Octw\Aramex\Aramex;

class TestController extends Controller
{
//    public function __construct()
//    {
//        app()->setLocale('en');
//    }

    public function __invoke()
    {

        $soapClient = new \SoapClient('shippingW.wsdl');
        $params = array(
            'Shipments' => array(
                'Shipment' => array(
                    'Shipper'	=> array(
                        'Reference1' 	=> 'Ref 111111',
                        'Reference2' 	=> 'Ref 222222',
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
                        'Reference1'	=> 'Ref 333333',
                        'Reference2'	=> 'Ref 444444',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '15 ABC St',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> 'Dammam',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),

                        'Contact'		=> array( //الشخص المستلم
                            'Department'			=> '',
                            'PersonName'			=> 'Mazen',
                            'Title'					=> '',
                            'CompanyName'			=> 'Aramex',
                            'PhoneNumber1'			=> '6666666',
                            'PhoneNumber1Ext'		=> '155',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '01006986069',
                            'EmailAddress'			=> 'mazen@aramex.com',
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
                    'Reference1' 				=> 'Shpt 0333', // order number
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

    public function oldinvoke()
    {

        $address = (new Address())->setCountryCode('SA')->setLine1('SA Dist. Name')->setCity('Alrass');

        $contact = (new Contact())->setPhoneNumber1('0504966997')
            ->setCellPhone('0504966997')
            ->setPersonName(env('ARAMEX_USERNAME'))
            ->setCompanyName(env('ARAMEX_USERNAME'))
            ->setEmailAddress(env('ARAMEX_USERNAME'));

        $shipperParty = (new Party())->setReference1('3333')->setPartyAddress($address)->setContact($contact);

        $address = (new Address())->setCountryCode('SA')->setLine1('SA Dist. Name')->setCity('Alrass');

        $contact = (new Contact())->setPhoneNumber1('0506666997')
            ->setCellPhone('0504966997')
            ->setPersonName('ramy ahmed')
            ->setCompanyName('ramy ahmed')
            ->setEmailAddress('ramyahmedhandousa@gmail.com');

        $consignee = (new Party())->setReference1('3333')->setPartyAddress($address)->setContact($contact);

        $details = (new ShipmentDetails());

        $addressThirdParty = (new Address())->setCountryCode('SA')->setLine1('SA Dist. Name')->setCity('Alrass');

        $contactThirdParty = (new Contact())->setPhoneNumber1('0504966997')
            ->setCellPhone('0504966997')
            ->setPersonName(env('ARAMEX_USERNAME'))
            ->setCompanyName(env('ARAMEX_USERNAME'))
            ->setEmailAddress(env('ARAMEX_USERNAME'));

        $thirdParty = (new Party())->setAccountNumber('60535771')->setPartyAddress($addressThirdParty)->setContact($contactThirdParty);

        $shippingDetails = (new ShipmentDetails())
            ->setNumberOfPieces(1)
            ->setGoodsOriginCountry('SA')
            ->setProductGroup('DOM')
            ->setProductType('CDS')
            ->setPaymentType('3');

        $newShip = (new Shipment())
            ->setReference1('Ref 1234')
            ->setShipper($shipperParty)
            ->setConsignee($consignee)
            ->setThirdParty($thirdParty)
            ->setPickupLocation('Reception')
            ->setDetails($details)
            ->setTransportType(0)
            ->setShippingDateTime(time())
            ->setDueDate(time())
            ->setDetails($shippingDetails);


        $labelInfo = (new LabelInfo())->setReportId(9201)->setReportType('URL');

        $shipping =  Aramex::createShipments()
            ->addShipment($newShip)
            ->setLabelInfo($labelInfo)
            ->run();

        return $shipping;
        $source = (new Address())->setLine1('SA Dist. Name')->setCity('Alrass')->setCountryCode('SA');

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

        $timeClose =   Carbon::createFromFormat('H:i:s', '16:00:00')->timestamp;

        $pickup = (new Pickup())
            ->setPickupAddress($source)
            ->setPickupContact($contact)
            ->setPickupLocation('Reception')
            ->setPickupDate(Carbon::now()->addHours(3)->timestamp)
            ->setReadyTime(Carbon::now()->addHours(3)->timestamp)
            ->setLastPickupTime($timeClose)
            ->setClosingTime($timeClose)
            ->setComments('pls be carefuller')
            ->setStatus('Ready')
            ->setReference1('3333')
            ->addPickupItem($pickupItem);

        $labelInfo = (new LabelInfo())->setReportId(9201)->setReportType('URL');

        $createPickup = Aramex::createPickup()->setLabelInfo($labelInfo)->setPickup($pickup)->run();

        $guid =  $createPickup->getPrecessedPickup()->getGUID();

        return $guid;
        $timeClose =   Carbon::createFromFormat('H:i:s', '16:00:00')->timestamp;

        $soapClient = new \SoapClient('shippingW.wsdl');
        echo '<pre>';

        $params = [
            "Pickup"=> [
                "PickupAddress"=> [
                    "Line1" => "SA Dist. Name",
                    "Line2" => "",
                    "Line3" => "",
                    "City"  => "Abha",
                    "StateOrProvinceCode"=> "",
                    "PostCode"      => "",
                    "CountryCode"   => "SA",
                    "Longitude"     => null,
                    "Latitude"      => null,
                    "BuildingNumber"=> null,
                    "BuildingName"  => null,
                    "Floor"         => null,
                    "Apartment"     => null,
                    "POBox"         => null,
                    "Description"   => null
                ],
                "PickupContact"=> [
                    "Department"    => "",
                    "PersonName"    => "ahmed22",
                    "Title"         => "",
                    "CompanyName"   => "ahmed22",
                    "PhoneNumber1"  => "+966509395144",
                    "PhoneNumber1Ext"=> "",
                    "PhoneNumber2"  => "",
                    "PhoneNumber2Ext"=> "",
                    "FaxNumber"     => "",
                    "CellPhone"     => "+966509395144",
                    "EmailAddress"  => "ahmed22@email.com",
                    "Type"          => ""
                ],
                "PickupLocation"    => "Recption",
                "PickupDate"        => Carbon::now()->addHours(3)->timestamp,
                "ReadyTime"         => Carbon::now()->addHours(3)->timestamp,
                "LastPickupTime"    => $timeClose,
                "ClosingTime"       => $timeClose,
                "Comments"          => "",
                "Reference1"        => "35",
                "Reference2"        => "",
                "Vehicle"           => "",
                "PickupItems"=> [
                    [
                        "ProductGroup"=> "DOM",
                        "ProductType"=> "CDS",
                        "NumberOfShipments"=> 1,
                        "PackageType"=> null,
                        "Payment"=> "3",
                        "ShipmentWeight"=> [
                        "Unit"=> "kg",
                            "Value"=> 20.0
                        ],
                        "ShipmentVolume"=> null,
                        "NumberOfPieces"=> 1,
                        "CashAmount"=> null,
                        "ExtraCharges"=> null,
                        "ShipmentDimensions"=> [
                        "Length"=> 10.0,
                            "Width"=> 10.0,
                            "Height"=> 20.0,
                            "Unit"=> "cm"
                        ],
                        "Comments"=> ""
                    ]
                ],
                "Status"=> "Ready",
                "ExistingShipments"=> null,
                "Branch"=> "",
                "RouteCode"=> "",
                "Dispatcher"=> 0
            ],
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
        ];

        print_r($params);

        try {
            $auth_call = $soapClient->CreatePickup($params);
            echo '<pre>';
            print_r("--------------------------------------");
            print_r($auth_call);
            die();
        } catch (\SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
        }

        return 'ok';

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $soapClient = new \SoapClient('shippingW.wsdl');
        echo '<pre>';
//        print_r($soapClient->__getFunctions());

        $params = array(
            'Shipments' => array(
                'Shipment' => array(
                    'Shipper'	=> array(
                        'Reference1' 	=> 'Ref 111111',
                        'Reference2' 	=> 'Ref 222222',
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
                        'Reference1'	=> 'Ref 333333',
                        'Reference2'	=> 'Ref 444444',
                        'AccountNumber' => '',
                        'PartyAddress'	=> array(
                            'Line1'					=> '15 ABC St',
                            'Line2'					=> '',
                            'Line3'					=> '',
                            'City'					=> 'Dammam',
                            'StateOrProvinceCode'	=> '',
                            'PostCode'				=> '',
                            'CountryCode'			=> 'SA'
                        ),

                        'Contact'		=> array( //الشخص المستلم
                            'Department'			=> '',
                            'PersonName'			=> 'Mazen',
                            'Title'					=> '',
                            'CompanyName'			=> 'Aramex',
                            'PhoneNumber1'			=> '6666666',
                            'PhoneNumber1Ext'		=> '155',
                            'PhoneNumber2'			=> '',
                            'PhoneNumber2Ext'		=> '',
                            'FaxNumber'				=> '',
                            'CellPhone'				=> '01006986069',
                            'EmailAddress'			=> 'mazen@aramex.com',
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
                    'Reference1' 				=> 'Shpt 0333', // order number
                    'Reference2' 				=> '',
                    'Reference3' 				=> '',
                    'ForeignHAWB'				=> '',
                    'TransportType'				=> 0,
                    'ShippingDateTime' 			=> time(),
                    'DueDate'					=> time(),
                    'PickupLocation'			=> 'Reception',
                    'PickupGUID'				=> '',
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

        print_r($params);

        try {
            $auth_call = $soapClient->CreateShipments($params);
            echo '<pre>';
            print_r("--------------------------------------");
            print_r($auth_call);
            die();
        } catch (\SoapFault $fault) {
            die('Error : ' . $fault->faultstring);
        }
    }

    public function test()
    {
//        return Aramex::fetchCities()
//            ->setCountryCode('SA')
//            ->run()
//            ->getCities();

//        return Aramex::fetchCountry()->setCode('SA')->run()->getCountry();

        $source = (new Address())->setLine1('test')->setCountryCode('SA');

        $contact = (new Contact());

        $wight = (new Weight());

        $pickupItem = (new PickupItem())
            ->setProductGroup('Express')
            ->setProductType('Appendix')
            ->setNumberOfShipments(3)
            ->setPayment('cash')
            ->setShipmentWeight($wight)
            ->setNumberOfPieces(3);

        $pickup = (new Pickup())
            ->setPickupAddress($source)
            ->setPickupContact($contact)
            ->setPickupLocation('Reception')
            ->setPickupDate(Carbon::now()->timestamp)
            ->setReadyTime(Carbon::now()->timestamp)
            ->setLastPickupTime(Carbon::now()->addDay()->timestamp)
            ->setClosingTime(Carbon::now()->addDay()->timestamp)
            ->setStatus('Pending')
            ->setReference1('')
            ->addPickupItem($pickupItem);

        $labelInfo = (new LabelInfo())
            ->setReportId(9201)
            ->setReportType('URL');

        $data = Aramex::createPickup()
            ->setLabelInfo($labelInfo)
            ->setPickup($pickup)
            ->run();

        return $data;
        $pickup = Aramex::createPickup([
            'name'          => 'Ramy',
            'cell_phone'    => '+123123123',
            'phone'         => '+123123123',
            'email'         => 'ramy@gmail.com',
            'city'          => 'riyadh',
            'country_code'  => 'SA',
            'zip_code'      => 10001,
            'line1'         => 'The line1 Details',
            'line2'         => 'The line2 Details',
            'line3'         => 'The line2 Details',
            'pickup_date'   => Carbon::now()->addDay()->timestamp,
            'ready_time'        => Carbon::now()->timestamp,
            'last_pickup_time'  => Carbon::now()->addDays(2)->timestamp,
            'closing_time'      => Carbon::now()->addDays(2)->timestamp,
            'status'            => 'Ready',
            'pickup_location'   => 'some location',
            'weight'            => 123,
            'volume'            => 1
        ]);

        $guid = $pickup->pickupGUID;

        $shipping = Aramex::createShipment([
            'shipper' => [
                'name'          => 'Steve',
                'email'         => 'email@users.companies',
                'phone'         => '+123456789982',
                'cell_phone'    => '+321654987789',
                'city'          => 'Riyadh',
                'country_code'  => 'SA',
                'zip_code'      => 12211,
                'party_Address' => [
                    'Line1'                 => 'Line1 Details',
                    'Line2'                 => 'Line1 Details',
                    'Line3'                 => 'Line1 Details',
                    'City'                  => 'Riyadh',
                    'StateOrProvinceCode'   => 'SA-01',
                    'PostCode'              => '12211',
                    'CountryCode'           => 'SA',
                    'Longitude'             => '46.6753',
                    'Latitude'              => '24.7136',
                    'BuildingNumber'        => '55',
                    'BuildingName'          => 'ramy',
                    'POBox'                 => 'line',
                    'Description'           => 'my home',
                    'Apartment'             => 'home',
                    'Floor'                 => '4',
                ],
                'line1' => 'Line1 Details',
                'line2' => 'Line2 Details',
                'line3' => 'Line3 Details',
            ],
            'consignee' => [
                'name'          => 'Steve',
                'email'         => 'email@users.companies',
                'phone'         => '+123456789982',
                'cell_phone'    => '+321654987789',
                'city'          => 'cairo',
                'country_code'  => 'EG',
                'zip_code'      => 12211,
                'line1'         => 'Line1 Details',
                'line2'         => 'Line2 Details',
                'line3'         => 'Line3 Details',
            ],
            'shipping_date_time' => Carbon::now()->addDay()->timestamp, // shipping date
            'due_date' => Carbon::now()->addDay()->timestamp,  // due date of the shipment
            'comments' => 'No Comment', // ,comments
            'pickup_location' => 'at reception', // location as pickup
            'pickup_guid' => $guid, // GUID taken from createPickup method (optional)
            'weight' => 1, // weight
            'goods_country' => null, // optional
            'number_of_pieces' => 1,  // number of items
            'description' => 'Goods Description, like Boxes of flowers', // description
            'reference' => '01020102' ,// reference to print on shipment report (policy)
            'shipper_reference' => '19191', // optional
            'consignee_reference' => '010101', // optional
            'services' => 'CODS,FIRST,FRDM, .. ', // ',' seperated string, refer to services in the official documentation
            'cash_on_delivery_amount' => 10.32 ,// in case of CODS (in USD only "as they want")
            'insurance_amount' => 0, // optional
            'collect_amount' => 0, // optional
            'customs_value_amount' => 0, //optional (required for express shipping)
            'cash_additional_amount' => 0, // optional
            'cash_additional_amount_description' => 'Something here',
            'product_group' => 'DOM', // or EXP (defined in config file, if you dont pass it will take the config value)
            'product_type' => 'PPX', // refer to the official documentation (defined in config file, if you dont pass it will take the config value)
            'payment_type' => 'P', // P,C, 3 refer to the official documentation (defined in config file, if you dont pass it will take the config value)
            'payment_option' => null,
        ]);

        return $shipping;
    }


    public function testOctwAramex()
    {
//        $data = Aramex::fetchCities('sa');

//        $pickup = Aramex::createPickup([
//            'name' => 'MyName',
//            'cell_phone' => '+123123123',
//            'phone' => '+123123123',
//            'email' => 'myEmail@gmail.com',
//            'city' => 'New York',
//            'country_code' => 'US',
//            'zip_code'=> 10001,
//            'line1' => 'The line1 Details',
//            'line2' => 'The line2 Details',
//            'line3' => 'The line2 Details',
//            'pickup_date' => Carbon::now()->timestamp,
//            'ready_time' => Carbon::now()->timestamp,
//            'last_pickup_time' => Carbon::now()->addDay()->timestamp,
//            'closing_time' => Carbon::now()->addDay()->timestamp,
//            'status' => 'Ready',
//            'pickup_location' => 'some location',
//            'weight' => 123,
//            'volume' => 1
//        ]);
//
//        return $pickup;
        // extracting GUID
        if (!$pickup->error)
            $guid = $pickup->pickupGUID;

        $data = Aramex::createShipment([
            'shipper' => [
                'name' => 'Steve',
                'email' => 'email@users.companies',
                'phone'      => '+123456789982',
                'cell_phone' => '+321654987789',
                'country_code' => 'US',
                'city' => 'New York',
                'zip_code' => 10001,
                'line1' => 'Line1 Details',
                'line2' => 'Line2 Details',
                'line3' => 'Line3 Details',
            ],
            'consignee' => [
                'name' => 'Steve',
                'email' => 'email@users.companies',
                'phone'      => '+123456789982',
                'cell_phone' => '+321654987789',
                'country_code' => 'US',
                'city' => 'New York',
//                'zip_code' => 10001,
                'line1' => 'Line1 Details',
                'line2' => 'Line2 Details',
                'line3' => 'Line3 Details',
            ],
            'shipping_date_time' => time() + 50000, // shipping date
            'due_date' => time() + 60000,  // due date of the shipment
            'comments' => 'No Comment', // ,comments
            'pickup_location' => 'at reception', // location as pickup
            'pickup_guid' => $guid, // GUID taken from createPickup method (optional)
            'weight' => 1, // weight
            'goods_country' => null, // optional
            'number_of_pieces' => 1,  // number of items
            'description' => 'Goods Description, like Boxes of flowers', // description
            'reference' => '01020102' ,// reference to print on shipment report (policy)
            'shipper_reference' => '19191', // optional
            'consignee_reference' => '010101', // optional
            'services' => 'CODS,FIRST,FRDM, .. ', // ',' seperated string, refer to services in the official documentation
            'cash_on_delivery_amount' => 10.32 ,// in case of CODS (in USD only "as they want")
            'insurance_amount' => 0, // optional
            'collect_amount' => 0, // optional
            'customs_value_amount' => 0, //optional (required for express shipping)
            'cash_additional_amount' => 0, // optional
            'cash_additional_amount_description' => 'Something here',
            'product_group' => 'DOM', // or EXP (defined in config file, if you dont pass it will take the config value)
            'product_type' => 'PPX', // refer to the official documentation (defined in config file, if you dont pass it will take the config value)
            'payment_type' => 'P', // P,C, 3 refer to the official documentation (defined in config file, if you dont pass it will take the config value)
            'payment_option' => null,
        ]);
       return $data;
    }
}
