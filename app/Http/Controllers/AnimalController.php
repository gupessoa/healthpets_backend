<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\TemplateVacina;
use App\Models\User;
use App\Notifications\PetAddEmailNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AnimalController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animais = User::find(Auth::user()->id)->animais()->get();
        if(empty($animais)){
            return response()->json([], 200);
        }

        return response()->json($animais, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnimalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $foto ='';
        if($request->hasFile('foto')){
           $foto =  $request->file('foto')->store('pets', 'public');
        }else{
            $foto = 'pets/default.png';
        }

        $nome = $request['nome'];
        $data_nascimento = Carbon::createFromDate($request['data_nascimento']);
        $id_especie = $request['id_especie'];
        $id_raca = $request['id_raca'];

        $animal = new Animal([
            'nome' => $nome,
            'data_nascimento' => $data_nascimento,
            'foto' => $foto,
            'id_especie' => $id_especie,
            'id_raca'=> $id_raca
        ]);

        $animal->saveOrFail();

        $animal->users()->attach(Auth::id(), ['owner' => 's']);
        $user = auth()->user();
        $template_vacina = TemplateVacina::where('id', '=', $id_especie)->get()->all();

        $vacinas = json_decode($template_vacina[0]['nome']);
        $frequencia = json_decode($template_vacina[0]['frequencia']);
        $periodo = json_decode($template_vacina[0]['periodo_frequencia']);

        if($vacinas == '{#1411}' and $vacinas != null) {

            $table = '';

            for ($i = 0; $i < count($vacinas); $i++) {
                $table .= ' A vacina ' . $vacinas[$i] . ' precisa ser aplicada de ' . $frequencia[$i]
                    . ' em ' . $frequencia[$i] . ' '
                    . $periodo[$i] . '.';
            }

            $info = [
                'greeting' => 'Ol?? ' . $user->nome . ',',
                'body' => 'Obrigado por cadastrar o ' . $nome . ' no HealthPets. Ficamos Felizes em poder ajudar' .
                    'Segue uma lista das vacinas mais comuns aplicadas a seu animal: ' . $table
                //            '<table class="demo">
                //                <thead>
                //                <tr>
                //                    <th>Nome Vacina</th>
                //                    <th>Frequ??ncia</th>
                //                    <th>Periodo</th>
                //                </tr>
                //                </thead>
                //                <tbody>
                //                <tr>'.
                //                 $table
                //                .'</tr>
                //                </tbody>
                //            </table>
                ,
                'thanks' => 'Obrigado por escolher o HealthPets. Cadastre novas e as antigas vacinas do seu Pet.',
                'actionText' => 'Cadastrar Vacinas',
                'actionURL' => url('/home'),
                'id' => 57
            ];

            Notification::send($user, new PetAddEmailNotification($info));
        }

        return response()->json([$animal], 200);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Animal::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AnimalRequest  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, int $id)
    {
        $foto = '';
        $animal = Animal::find($id);

        $animal->nome = $request->nome;
        $animal->data_nascimento = $request->data_nascimento;
        dd(explode('/', $request->file('foto')));

        if($request->hasFile('foto')){
            $foto =  explode('/', $request->file('foto')->store('pets', 'public'))[1];
            if(Storage::exists($animal->foto)){
                Storage::delete($animal->foto);
            }
        }else{
            $foto = $animal->foto;
        }

        $animal->foto = $foto;
        $animal->id_especie = $request->id_especie;
        $animal->id_raca = $request->id_raca;

        return response()->json($animal->save(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return response()->json(['message' => 'Animal deletado com sucesso'], 200);
    }

    /**
     *  create de hash to share the animal with another user
     * @param int $id_animal
     * @return \Illuminate\Http\JsonResponse
     */
    public function shareAnimal(int $id_animal)
    {
        $codigo = Hash::make($id_animal.''.(\Carbon\Carbon::now()));
        DB::table('compartilhamento')
            ->insert([
                'codigo' => $codigo,
                'validade' => \Carbon\Carbon::now()->addMinutes(60),
                'ativo' => 's',
            ]);

        return response()->json(['codigo' => $codigo], 200);
    }

    /**
     * add the shared animal in the account of the current user
     *
     * @param int $id_animal
     * @param string $codigo
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveSharedAnimal(int $id_animal, string $codigo)
    {
        $codigo = DB::table('compartilhamento')->where('codigo', $codigo)->get()->ativo ;
        if($codigo['ativo'] == 'n' || \Carbon\Carbon::now()->greaterThan($codigo['created_at'])){
            return response()->json(['error' => 'C??digo inv??lido ou Tempo de compartilhamento expirado.'], 422);
        }
        DB::table('compartilhamento')->update(['ativo'=>'n'])->where('codigo', $codigo);
        $animal = Animal::find($id_animal);
        $animal->users()->attach(Auth::id(), ['owner' => 'n']);

        return response()->json(['message' => 'Animal compartilhado com sucesso'], 200);
    }

    public function update_foto(Request $request ){
        $animal = Animal::find($request->id);

        $foto ='';
        if($request->hasFile('foto')){
            $foto =  $request->file('foto')->store('pets', 'public');
        }

        $animal->foto = $foto;

        return response()->json($animal->save(), 200);

    }
}
