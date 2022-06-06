<?php

namespace App\Http\Controllers;

use App\Models\Lembrete;
use Illuminate\Http\Request;

class LembreteController extends Controller
{
    //precia de método para adicionar
    //precisa de métodfo para fazer update
    //método para retornar todos de um usuario
    //metod para retornar um apenas
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lembrete  $lembrete
     * @return \Illuminate\Http\Response
     */
    public function show(Lembrete $lembrete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lembrete  $lembrete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lembrete $lembrete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lembrete  $lembrete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lembrete $lembrete)
    {
        //
    }
}
