<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedimentoRequest;
use App\Http\Requests\UpdateProcedimentoRequest;
use App\Models\Procedimento;

class ProcedimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todo é possivel criar uma rota exclusiva para pegar o sprocedimentos por animal e outra rota por usuario, e ai precisa criar os métodos correspondentes.
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
        //todo atualizar o mer e der adc o campo descricao-
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
