<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Sms
{

    public static function sendMessageToPhone ($phone,$msg)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.hisms.ws/api.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('send_sms' => '','username' => '966504966997','password' => 'Ali@8177460','numbers' => $phone,'sender' => 'Almaha eye','message' => $msg),
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=a7bqhp8ft60vk28vhajspni7t2'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

    }
    //------------ Msgat --------------
//    public static function sendMessageToPhone ($phone,$msg)
//    {
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//
//        curl_setopt($ch, CURLOPT_POST, TRUE);
//
//        $fields  = json_encode([
//            "userName"      => "almaha",
//            "numbers"      => $phone,
//            "userSender"   => "almahaeye",
////            "apiKey"       => "40d3b8974d217c0c60d1fe0ffb2a2ad2",
//            "apiKey"       => "d51d0185203081951db3b40867c60c13",
//            "msg"          => $msg
//        ]);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Content-Type: application/json"
//        ));
//
//        $response = curl_exec($ch);
//        $info = curl_getinfo($ch);
//        curl_close($ch);
//
//        return $info;
//    }


    public static function test($phone,$msg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $fields = <<<EOT
{
  "userName": "almaha",
  "numbers": "+966591496036",
  "userSender": "almahaeye",
  "apiKey": "40d3b8974d217c0c60d1fe0ffb2a2ad2",
  "msg": "cascascascas"
}
EOT;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        var_dump($info["http_code"]);
        var_dump($response);
    }

}
