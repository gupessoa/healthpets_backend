<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Models\Animal;
use App\Models\Despesa;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pegando todas as despesas dos animais do usuário?
    }

    public function getByAnimal(int $id)
    {
        $animal = Animal::find($id);
        $despesas = $animal->despesas();

        return response($despesas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DespesaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DespesaRequest $request)
    {
        $despesa = new Despesa([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data,
            'id_categoria' => $request->id_categoria
        ]);

        $despesa->saveOrFail();

        $animais = json_decode($request->divido_por);
        $porcentagem = json_decode($request->porcentagem);

        for($i = 0; $i < sizeof($animais); $i++){
            Animal::find($animais[$i])
                ->attach($despesa->id,
                    [
                        'porcentagem' => $porcentagem[$i],
                        'total_animal' => ($request->valor*$porcentagem[$i])/100
                        ]);
        }

        return response()->json($despesa, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //todo implementar o retorno de despesa de cada animal,
        //todo aqui é interessante retornar os campos total_animal e porcentagem da compra da tabela pivot
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DespesaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DespesaRequest $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Despesa::find($id)->delete();
        return response()->json(['message' => 'Despesa deletada com sucesso'], 200);
    }
}
