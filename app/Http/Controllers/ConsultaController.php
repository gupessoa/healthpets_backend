<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaRequest;
use App\Http\Requests\UpdateConsultaRequest;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $id)
    {
        //pegar as consultas por animais
        $consultas = Consulta::where('id_animal', '=', $id);
        return response()->json($consultas, '200');
    }

    public function getByUser(int $id)
    {
        $user = User::find(Auth::id());
        $animais_id = $user->animais()->pluck('animais.id');
        $consultas = DB::table('consultas')
                        ->whereIn('id_animal', $animais_id)
                        ->get();
        return response()->json($consultas, '200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ConsultaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultaRequest $request)
    {
        $descricao = $request->descricao;
        $data = $request->data;
        $horario = $request->horario;
        $id_animal = $request->id_animal;
        $id_local = $request->id_local;

        $consulta = new Consulta([
            'descricao' => $descricao,
            'data' => $data,
            'horario' => $horario,
            'id_animal' => $id_animal,
            'id_local' => $id_local,
        ]);

        $consulta->saveOrFail();
        return response()->json($consulta, '200');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Consulta::findOrFail($id), '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ConsultaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultaRequest $request, int $id)
    {
        $consulta = Consulta::find($id);

        $consulta->descricao = $request->descricao;
        $consulta->data = $request->data;
        $consulta->horario = $request->horario;
        $consulta->id_animal = $request->id_animal;
        $consulta->id_local = $request->id_local;

        return response()->json($consulta->updateOrFail(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Consulta::find($id)->delete();
        return response()->json(['message' => 'Consulta deletada com sucesso'], 200);
    }
}
