<?php

namespace App\Http\Helpers;

class Sms
{
    //------------ Msgat --------------
    public static function sendMessageToPhone ($phone,$msg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $fields  = json_encode([
            "userName"      => "almaha",
            "numbers"      => $phone,
            "userSender"   => "almahaeye",
            "apiKey"       => "40d3b8974d217c0c60d1fe0ffb2a2ad2",
            "msg"          => $msg
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        return $info;
    }


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
