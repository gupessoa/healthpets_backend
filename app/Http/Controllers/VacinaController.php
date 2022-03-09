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
    public function index(int $animal_id)
    {
        $vacinas = Animal::findOrFail($animal_id)->vacinas()->get();
        return response()->json($vacinas, '200');
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

        $vacina->name = $request->name;
        $vacina->application_date = $request->application_date;
        $vacina->manufacture = $request->manufacture;
        $vacina->batch = $request->batch;

        return response()->json($vacina->update(), 200);
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
        return response()->json(['message' => 'Successfully deleted vacina.'], 200);
    }
}
