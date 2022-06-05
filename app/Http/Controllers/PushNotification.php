<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotification extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');

    }

//    public function storeToken(Request $request, $id)
//    {
//        $dados = $request->except('_token');
//        DB::table('users')->where('id', $id)->update(['device_key'=>$dados['token']]);
//        return response()->json(['Token successfully stored.']);
//    }

    public static function sendWebNotification($dados)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $link = '';
        $serverKey = 'AAAABpoJZdI:APA91bHb0W4JQ3eQX5OklXpITZF0M_QGRF5IgW5ZT8ilYqpVvgLtulwuRVFnG2tSQ6WZXqKPOACrDY2EVpbFkSi_vC8jH-uoMzC8O5tfHDopPyV7T0RF9M6xcKK4pxziqWtPt-NX_9Mw';
        $data = array(
//            "registration_ids" => array($dados['device_key']),
            "notification" => [
                "title" => $dados['title'],
                "body" => $dados['body'],
            ],
            "priority" =>  "high",
            "data" => [
                "click_action"  =>  "FLUTTER_NOTIFICATION_CLICK",
                "id"            =>  "1",
                "status"        =>  "done",
                "info"          =>  [
                    "title"  => $dados['title'],
                    "link"   => $dados['link'],
                ]
            ],
            "to" => "<YOUR_FIREBASE_TOKEN>"

        );
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        curl_close($ch);
    }
}
