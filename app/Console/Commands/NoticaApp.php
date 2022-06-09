<?php

namespace App\Console\Commands;

use App\Models\DeviceToken;
use App\Models\Lembrete;
use Illuminate\Console\Command;
use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PushNotification;

class NoticaApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'notifica:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send push notification to devices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $dados['title'] = 'HealthPets Informa';
        $dados['body'] = "Olá, informamos que tem um compromisso com o(a) ANimal!";
        $dados['link'] = 'https:\\www.healthpets.app.br\api\calendario';
        $devices = DeviceToken::where('id_user', '=', 1)->get();
        $dados['device_key'] = 'cGvNR1_1R_aJs7a4QNvYn-:APA91bGsVkGcHwTtFnf6Qx2KCu6jdXBFyeFp11J1J-OY1zQisJEqbl_b6qC7AC43JKNtm7kJprBoG_gm0AIWqqsIdp19mTYmwshScTAuq9k5zZcgVDtSSGglcB513jQ3LbU_nd-tSx1g';
        PushNotification::sendPushNotification($dados);

        /*
        $app_id = 'a907856b-d11b-4ecc-b943-e2284e2e29e3';
        $rest_key = 'OTE3ZTFiYzEtNmMzNi00M2UzLTg1MDQtZDU3MTQ0OTkxMGQ3';
//        $agora = Carbon::now()->format("Y-m-d");
        $agora = Carbon::now()->format('H:i');
//        $proxima = Carbon::now()->addDay()->format("Y-m-d");
        $proxima = Carbon::now()->addHour()->format('H:i');

//        $lembrete = Lembrete:: where('hora', '<', $proxima)->get();
        $lembretes = DB::table('lembretes')->whereBetween('home', [$agora, $proxima])->get();
//        $vacinas = Vacina::where('data_aplicacao', '=', $amanha)->get();

        if (!empty($lembretes)) {
            foreach ($lembretes as $lembrete) {
                $animal = Animal::find(Lembrete::find($lembrete->animal_id));
                $users = $animal->users();
                $dados = [];
                foreach ($users as $user) {
                    $dados['title'] = 'HealthPets Informa';
                    $dados['body'] = "Olá, informamos que tem um compromisso com o(a) $animal->nome!";
                    $dados['link'] = 'https:\\www.healthpets.app.br\api\calendario';
                    $devices = DeviceToken::where('id_user', '=', $user->id)->get();

                    foreach ($devices as $device){
                        $dados['device_key'] = $device;
                        PushNotification::sendPushNotification($dados);
//                        $this->sendMessage( $device , $mensagem);
                    }
                }
            }

        }*/
    }

//    public function sendMessage($user_id, $message)
//    {
//        if($user_id != '' or !is_null($user_id) ){
//            $content = array(
//                "en" => $message,
//                "pt-BR" => $message
//            );
//
//            $fields = array(
//                'app_id' => 'a907856b-d11b-4ecc-b943-e2284e2e29e3',
//                'include_player_ids' => array($user_id),
//                'data' => array("foo" => "bar"),
//                'contents' => $content
//            );
//
//            $fields = json_encode($fields);
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'Content-Type: application/json; charset=utf-8',
//                'Authorizaion: Basic OTE3ZTFiYzEtNmMzNi00M2UzLTg1MDQtZDU3MTQ0OTkxMGQ3'
//            ));
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//            curl_setopt($ch, CURLOPT_HEADER, FALSE);
//            curl_setopt($ch, CURLOPT_POST, TRUE);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//            $response = curl_exec($ch);
//            curl_close($ch);
//
//            return $response;
//        }
//
//        return false;
//
//    }
}
