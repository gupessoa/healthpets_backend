<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Categoria::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria([
            'nome' => $request->nome,
        ]);

        $categoria->saveOrFail();

        return response()->json($categoria, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Categoria::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoriaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, int $id)
    {
        $categoria = Categoria::find($id);

        $categoria->nome = $request->nome;

        return response()->json($categoria->updateOrFail(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Categoria::find($id)->delete();
        return response()->json(['message' => 'Categoria deletada com sucesso'], 200);
    }
}
