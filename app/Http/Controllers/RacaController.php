<?php

namespace App\Http\Controllers;

use App\Http\Requests\RacaRequest;
use App\Http\Requests\UpdateRacaRequest;
use App\Models\Raca;

class RacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $racas = Raca::all();
        return response()->json($racas,'200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RacaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RacaRequest $request)
    {
        $raca = new Raca([
            'nome' => $request->nome
        ]);

        $raca->saveOrFail();

        return response()->json(['message' => 'Raça adicionada com sucesso!'], '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $raca = Raca::findOrFail($id);
        return response()->json(['raca' => $raca], '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RacaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RacaRequest $request, int $id)
    {
        $raca = Raca::findOrFail($id);
        $raca->nome = $request->filled('nome') ? $request->nome : $raca->nome;

        $raca->updateOrFail();

        return response()->json(['message' => 'Raça atualiza com sucesso'], '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $raca = Raca::findOrFail($id);
        $raca->delete();
        return response()->json(['message' => 'Raça excluída com sucesso.'], '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getRacaByEspecie(int $id)
    {
        $racas = Raca::where('id_especie', $id)->get();
        return response()->json(['racas' => $racas], 200 );
    }
}
