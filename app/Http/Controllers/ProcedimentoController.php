<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedimentoRequest;
use App\Models\Procedimento;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ProcedimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Não teremos a rota para trazer todos os procedimentos de todos os animais do sistema
    }

    public function getByUser()
    {
        $date = Carbon::now()->subYear(1)->toDateString();
        $user = User::find(Auth::id());
        $animais_id = $user->animais()->pluck('animais.id');

        $procedimentos =  DB::table('procedimentos')
                            ->where('data','>=',$date)
                            ->whereIn('id_animal', $animais_id)
                            ->get();
        return response()->json($procedimentos, '200');
    }

    public function getByAnimal(int $id)
    {
        $date = Carbon::now()->subYear(1)->toDateString();
        $user = User::find(Auth::id());
        $animais_id = $user->animais()->pluck('animais.id');

        $procedimentos =  DB::table('procedimentos')
            ->where('data','>=',$date)
            ->whereIn('id_animal', $id)
            ->get();
        return response()->json($procedimentos, '200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProcedimentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcedimentoRequest $request)
    {
        $descricao = $request->descricao ;
        $data = $request-> data;
        $horario = $request->horario ;
        $id_animal = $request->id_animal ;
        $id_local = $request->id_local ;

        $procedimento = new Procedimento([
            'descricao' => $descricao,
            'data' => $data,
            'horario' => $horario,
            'id_animal' => $id_animal,
            'id_local' => $id_local,
        ]);

        $procedimento->saveOrFail();

        return response()->json($procedimento, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return  response()->json(Procedimento::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProcedimentoRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcedimentoRequest $request, int $id)
    {
        $procedimento = Procedimento::find($id);

        $procedimento->descricao = $request->descricao ;
        $procedimento->data = $request->data ;
        $procedimento->horario = $request->horario ;
        $procedimento->id_animal = $request->id_animal ;
        $procedimento->id_local = $request->id_local ;

        return response()->json($procedimento->updateOrFail(), '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Procedimento::find($id)->delete();
        return response()->json(['message' => 'Procedimento deletado com sucesso'], 200);
    }
}
