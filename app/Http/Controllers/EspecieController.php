<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecieRequest;
use App\Http\Requests\UpdateEspecieRequest;
use App\Models\Especie;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especies = Especie::all();
        return response()->json(['especies' => $especies], '200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EspecieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecieRequest $request)
    {
        $especie = new Especie([
            'nome' => $request->nome,
        ]);

        $especie->saveOrFail();
        return response()->json($especie, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $especie = Especie::find($id);
        return response()->json($especie, '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EspecieRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecieRequest $request, int $id)
    {
        $especie = Especie::find($id);
        $especie->nome = $request->nome;
        $especie->update();
        return response()->json($especie, '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Especie::find($id)->delete();
        return response()->json(['message' => 'Successfully deleted Especie.'], '200');
    }
}
