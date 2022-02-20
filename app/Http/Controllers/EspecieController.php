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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EspecieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show(Especie $especie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EspecieRequest  $request
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(EspecieRequest $request, Especie $especie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especie $especie)
    {
        //
    }
}
