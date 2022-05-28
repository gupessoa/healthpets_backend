<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Models\Info;
use Illuminate\Http\Request;

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

    public function getByAnimal(int $id)
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
        $info = new Info([
            'data'=>$request->data,
            'descricao'=>$request->descricao,
            'id_categoria'=>$request->id_categoria,
            'id_subcategoria'=>$request->id_subcategoria,
            'local'=>$request->local,
            'valor'=>$request->valor,
            'id_animal'=>$request->id_animal,
        ]);

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
     * @param  \App\Http\Requests\UpdateInfoRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, int $id)
    {
        $info = Info::find($id);

        $info->data = $request->data;
        $info->descricao=$request->descricao;
        $info->id_categoria=$request->id_categoria;
        $info->id_subcategoria=$request->id_subcategoria;
        $info->local=$request->local;
        $info->valor=$request->valor;
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
        return response()->json(['message' => 'informação deletada com sucesso']);
    }
}
