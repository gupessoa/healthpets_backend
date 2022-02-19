<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinaRequest;
use App\Http\Requests\UpdateVacinaRequest;
use App\Models\Animal;
use App\Models\Vacina;

class VacinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $animal, int $animal_id)
    {
        //TODO Ultimo a ser implementado o método index, que traz todas as vacinas
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VacinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacinaRequest $request, int $animal)
    {   $animal = Animal::find($animal);

        $name = $request->name;
        $application_date = $request->application_date;
        $manufacture = $request->manufacture;
        $batch = $request->batch;

        $vacina = new Vacina([
            'name' => $name,
            'application_date' => $application_date,
            'manufacture' => $manufacture,
            'batch' => $batch,
        ]);

        $vacina->saveOrFail();
        return response()->json($vacina, '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function show(int $animal, int $vacina)
    {
        //TODO implementar a busca das vacinas apenas para o animal do nested route
        return response()->json(Vacina::findOrFail($vacina), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVacinaRequest  $request
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function update(VacinaRequest $request, int $animal, int $id)
    {
        $vacina = Vacina::find($id);

        $vacina->name = $request->name;
        $vacina->application_date = $request->application_date;
        $vacina->manufacture = $request->manufacture;
        $vacina->batch = $request->batch;

        return response()->json($vacina->update(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $animal, int $id)
    {
        $animal = Animal::find();
        $vacina = Vacina::find($id);
        $vacina->delete();
        return response()->json(['message' => 'Successfully deleted vacina.'], 200);
    }
}
