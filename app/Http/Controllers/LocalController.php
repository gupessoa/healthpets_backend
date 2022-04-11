<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Models\Local;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Local::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalRequest $request)
    {
        $nome = $request->nome;
        $cep = $request->cep;
        $logradouro = $request->logradouro;
        $numero = $request->numero;
        $bairro = $request->bairro;
        $cidade = $request->cidade;
        $uf = $request->uf;
        $pais = $request->pais;

        $local = new Local([
            'nome' => $nome,
            'cep' => $cep,
            'logradouro' => $logradouro,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'uf' => $uf,
            'pais' => $pais,
        ]);

        $local->saveOrFail();
        return response()->json($local, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Local::findOrFail($id), '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LocalRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalRequest $request, int $id)
    {
        $local = Local::find($id);

        $local->nome = $request->nome;
        $local->cep = $request->cep;
        $local->logradouro = $request->logradouro;
        $local->numero = $request->numero;
        $local->bairro = $request->bairro;
        $local->cidade = $request->cidade;
        $local->uf = $request->uf;
        $local->pais = $request->pais;

        return response()->json($local->updateOrFail(), '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Local::find($id)->delete();
        return response()->json(['message' => 'Local deletado com sucesso'], 200);
    }
}
