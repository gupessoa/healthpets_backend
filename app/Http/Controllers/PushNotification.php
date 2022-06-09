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

    public static function sendPushNotification($dados)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $link = '';
        $serverKey = 'AAAA4Py--Bo:APA91bG7grnPQrmmQgIi43OVFxazj2CboUlht9sw54d66QEKiqdSkk861ghSStTvGebaCiyxxk7UgG13xlh-bgFEAKlrgHQN8H-MI3L-5fLt1M89NC1TufsfPoG98EvW2KW0oJ1A9Fmy';
//        $data = array(
////            "registration_ids" => array($dados['device_key']),
//            "notification" => [
//                "title" => $dados['title'],
//                "body" => $dados['body'],
//            ],
////            "priority" =>  "high",
//            "data" => [
////                "click_action"  =>  "FLUTTER_NOTIFICATION_CLICK",
////                "id"            =>  "1",
////                "status"        =>  "done",
////                "info"          =>  [
////                    "title"  => $dados['title'],
////                    "link"   => $dados['link'],
//                ]
//            ],
//            "to" => $dados['device_key'],
//
//        );

        $data = array(
            "to" => $dados['device_key'],
            "notification" => [
                "body" => $dados['body'],
                "title" => $dados['title'],
            ],
            "data" => [
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "link" => "/calendario",
            ],
//            "click_action" => "FFLUTTER_NOTIFICATION_CLICK"
        );
        $encodedData = json_encode($data);

        $headers = [
            'Authorization: Bearer ' . $serverKey,
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
