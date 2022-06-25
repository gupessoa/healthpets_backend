<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Models\Info;
use App\Models\Lembrete;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class InfoController extends Controller
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

    public function getByAnimal($id)
    {
        return response()->json(Info::where('id_animal', $id)->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InfoRequest $request)
    {
        $horas = explode(':', explode( ' ', $request->hora)[0]);
        $periodo = explode( ' ', $request->hora)[1];
        $horas = \Carbon\Carbon::createFromTime( $horas[0], $horas[1], '00');
        $horas = $periodo == 'PM' ? $horas->addHours(12)->format('H:i:s') : $horas->format('H:i:s');

        $info = new Info([
            'data'=>$request->data,
            'descricao'=>$request->descricao,
//            'adicionar_lembrete' => $request->adicionar_lembrete,
            'id_categoria'=>$request->id_categoria,
            'id_subcategoria'=>$request->id_subcategoria,
            'local'=>$request->local,
            'valor'=>$request->valor,
            'hora'=>$horas,
            'alerta' => $request->alerta,
            'id_animal'=>$request->id_animal,
        ]);

        if($request->alerta == true){
            $lembrete = new Lembrete([
                'titulo' =>$request->descricao,
                'data' =>$request->data,
                'descricao' =>$request->descricao,
                'hora' =>$horas,
                'id_user' => auth()->user()->id
            ]);

            $lembrete->save();
        }



        $info->saveOrFail();

        return response()->json($info, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Info::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InfoRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(InfoRequest $request, int $id)
    {
        $info = Info::find($id);

        $info->data = $request->data;
        $info->descricao=$request->descricao;
        $info->id_categoria=$request->id_categoria;
        $info->id_subcategoria=$request->id_subcategoria;
        $info->local=$request->local;
        $info->valor=$request->valor;
        $info->hora=$request->hora;
        $info->alerta = $request->alerta;
        $info->id_animal =$request->id_animal;

        $info->save();

        return response()->json($info, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $info = Info::find($id);
        $info->delete();
        return response()->json(['message' => 'informação deletada com sucesso'], 200);
    }

    public function listarInfosSaude(Request $request)
    {
        $subcategoria = intval($request->id_subcategoria);
        $animal = $request->id_animal;
        $dados = DB::table('infos')->where('id_animal', '=', $animal)->where('id_subcategoria', '=',$subcategoria)->get();

        return response()->json($dados, 200);
    }

    public function listarInfosFood(Request $request)
    {
        $categoria = 2;
        $animal = $request->id;
        $dados = Info::orderBy('data')->where('id_animal', '=', $animal)->where('id_categoria', '=', $categoria)->get();
        return response()->json($dados,200);
    }



    public function listarInfosFun(Request $request)
    {
        $categoria = 4;
        $animal = $request->id;
        $dados = Info::orderBy('data')->where('id_animal', '=', $animal)->where('id_categoria', '=', $categoria)->get();
        return response()->json($dados,200);
    }

    public function listarInfosHigiene(Request $request)
    {
        $categoria = 3;
        $animal = $request->id;
        $dados = Info::orderBy('data')->where('id_animal', '=', $animal)->where('id_categoria', '=', $categoria)->get();
        return response()->json($dados,200);
    }

    public function listarInfosAcessorios(Request $request)
    {
        $categoria = 1;
        $animal = $request->id;
        $dados = Info::orderBy('data')->where('id_animal', '=', $animal)->where('id_categoria', '=', $categoria)->get();
        return response()->json($dados,200);
    }
}
