<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NoticaApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifca:app';

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
        $app_id = 'a907856b-d11b-4ecc-b943-e2284e2e29e3';
        $rest_key = 'OTE3ZTFiYzEtNmMzNi00M2UzLTg1MDQtZDU3MTQ0OTkxMGQ3';
        //$hoje = date("Y/m/d");
        $hoje = Carbon::now()->format("Y-m-d");
        $amanha = Carbon::now()->addDay()->format("Y-m-d");
        //dd($amanha);

        //$vacinas = Vacina::where('data_aplicacao', '>', $hoje)->get();
        $vacinas = Vacina::where('data_aplicacao', '=', $amanha)->get();
        //$vacinas = DB::table('vacinas')->whereBetween('data_aplicacao', [$hoje, $amanha])->get();
        //dd($vacinas);

        if (!empty($vacinas)) {
            foreach ($vacinas as $vacina) {
                $animal = Animal::find($vacina->animal_id);
                $users = $animal->users;
                foreach ($users as $user) {
                    $mensagem = "Hora de vacinar o Pet. $animal->nome tem vacina próxima";
                    $this->sendMessage($user->device_key, $mensagem);
                    Mail::send(new VacinaNotifica($user, $vacina, $animal));
                }
            }

        }
    }

    public function sendMessage($user_id, $message)
    {
        if($user_id != '' or !is_null($user_id) ){
            $content = array(
                "en" => $message,
                "pt-BR" => $message
            );

            $fields = array(
                'app_id' => 'a907856b-d11b-4ecc-b943-e2284e2e29e3',
                'include_player_ids' => array($user_id),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorizaion: Basic OTE3ZTFiYzEtNmMzNi00M2UzLTg1MDQtZDU3MTQ0OTkxMGQ3'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }

        return false;

    }
}
