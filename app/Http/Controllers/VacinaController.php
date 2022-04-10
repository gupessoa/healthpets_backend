<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinaRequest;
use Illuminate\Support\Facades\Request;
use App\Models\Animal;
use App\Models\Vacina;

class VacinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $id)
    {
//        dd($id);
        $vacinas = Animal::findOrFail($id)->vacinas()->get();
        return response()->json($vacinas, '200');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VacinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacinaRequest $request)
    {

        $nome = $request->nome;
        $data_aplicacao = $request->data_aplicacao;
        $fabricante = $request->fabricante;
        $lote = $request->lote;
        $id_animal = $request->id_animal;

        $vacina = new Vacina([
            'nome' => $nome,
            'data_aplicacao' => $data_aplicacao,
            'fabricante' => $fabricante,
            'lote' => $lote,
            'id_animal' => $id_animal,
        ]);

        $vacina->saveOrFail();
        return response()->json($vacina, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Vacina::findOrFail($id), '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VacinaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacinaRequest $request, int $id)
    {
        $vacina = Vacina::find($id);

        $vacina->nome = $request->nome;
        $vacina->data_aplicacao = $request->data_aplicacao;
        $vacina->fabricante = $request->fabricante;
        $vacina->lote = $request->lote;

        return response()->json($vacina->updateOrFail(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Vacina::find($id)->delete();
        return response()->json(['message' => 'Vacina deletada com sucesso'], 200);
    }
}
