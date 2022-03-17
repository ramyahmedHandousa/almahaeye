<?php

namespace App\Support\FireBase;

use Illuminate\Support\Facades\Http;

class FireBase
{
    private const API_TOKEN = 'AAAAO0pLnLU:APA91bF3BJ5g2oM05V69mTWS1wO3XYq4EsuZi99WU3e9-ZDEpZag4BNVMMSc962jgVP8iBrAij2250VcYqEyGa6OqbIj3ryrQj0VIAqnRwnY_xCLjn80kbxZyOZbHU1k31_epJJJtMlU';

    public static function send(FireBaseModel $model) : bool
    {
        $result = self::usingTokens($model->androidTokens, $model->toData());
        $result &= self::usingTokens($model->iosTokens, $model->toMessage(), true);

        return $result;
    }

    public static function usingTokens(
        array $tokens,
        array $data,
        bool  $notification = false
    ) : bool {

        if (count($tokens) === 0) {
            return false;
        }
        $request = [
            'registration_ids'                      => $tokens,
            'priority'                              => 'high',
            $notification ? 'notification' : 'data' => $data,
        ];

        return self::makeRequest($request);
    }

    public static function usingTopic(string $topic, string $title, string $body) : bool
    {
        $request = [
            'to'           => '/topics/'.$topic,
            'notification' => [
                'title' => $title,
                'body'  => $body,
                'sound' => 'default',
                'badge' => '1',
            ],
            'data' => [
                'title' => $title,
                'body'  => $body,
                'sound' => 'default',
                'badge' => '1',
            ]
        ];

        return self::makeRequest($request);
    }

    public static function makeRequest(array $data, bool $debug = false) : bool
    {
        $client = Http::withHeaders([
            'Authorization' => 'key='.self::API_TOKEN,
            'Content-Type'  => ' application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', $data);

        $debug && info('firebase: '.$client->body());

        return $client->ok();
    }
}
