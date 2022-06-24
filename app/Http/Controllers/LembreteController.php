<?php

namespace App\Http\Controllers;

use App\Models\Lembrete;
use Illuminate\Http\Request;

class LembreteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getLembreteByDay(Request $request)
    {
        $dia = $request->dia;
        $mes = $request->mes;
        $ano = $request->ano;

        $data = $ano.'/'.$mes.'/'.$dia;

        $dados = Lembrete::where('data', $data)->get();

        return response()->json($dados, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lembrete = new Lembrete([
            'titulo' => $request->titulo,
            'data' => $request->data,
            'descricao' => $request->descricao,
            'hora' => $request->hora,
            ]
        );

        $lembrete->saveOrFail();

        return response()->json($lembrete, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int  $id)
    {
        return response()->json(Lembrete::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int  $id)
    {
        $lembrete = Lembrete::find($id);

        $lembrete->titulo = $request->titulo;
        $lembrete->data =$request->data;
        $lembrete->descricao =$request->descricao;
        $lembrete->hora =$request->hora;

        return response()->json($lembrete->save(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $lembrete = Lembrete::find($id);
        $lembrete->delete();

        return response()->json(['message' => 'Lembrete deletado com sucesso'], 200);
    }
}
