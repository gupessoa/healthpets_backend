<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiarioRequest;
use App\Models\Diario;

class DiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Implementado em outro método
    }

    /**
     * Display a listing of the resource by animal.
     *
     * * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getAllByAnimal(int $id)
    {
        return response()->json(Diario::where('id_animal', $id)->get(), '200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DiarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiarioRequest $request)
    {
        $diario = new Diario([
            'peso' =>  $request->peso,
            'humor' =>  $request->humor,
            'descricao' =>  $request->descricao,
            'titulo' =>  $request->titulo,
            'data' =>  $request->data,
            'id_animal' => $request->id_animal,
        ]);

        $diario->saveOrFail();

        return response()->json($diario, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Diario::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DiarioRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiarioRequest $request, int $id)
    {
        $diario = Diario::find($id);


        $diario->peso =  $request->peso;
        $diario->humor =  $request->humor;
        $diario->descricao =  $request->descricao;
        $diario->titulo = $request->titulo;
        $diario->data =  $request->data;
        $diario->id_animal = $request->id_animal;

        $diario->saveOrFail();

        return response()->json($diario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        Diario::find($id)->delete();
        return response()->json(['message' => 'Diario deletado com sucesso'], '200');
    }
}
