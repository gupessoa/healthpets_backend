<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateVacinaRequest;
use App\Http\Requests\UpdateTemplateVacinaRequest;
use App\Models\TemplateVacina;

class TemplateVacinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TemplateVacina::all(), '200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TemplateVacinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateVacinaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response(['template' => TemplateVacina::findOrFail($id)], '200');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TemplateVacinaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateVacinaRequest $request, int $id)
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
        $template = TemplateVacina::findOrFail($id);
        $template->delete();
        return response()->json(['message' => 'Template excluido com sucesso'], '200');
    }
}
