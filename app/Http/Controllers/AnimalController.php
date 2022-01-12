<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $animals = $user->animals;

        if(empty($animals)){
            return response()->json([], 200);
        }

        return response()->json($animals, 200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnimalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $name = $request['name'];
        $birth_date = Carbon::createFromDate($request['birth_date']);
        $photo = $request['photo'];

        if($birth_date->gt(Carbon::now()) ){
            return response()->json(['error'=>'The date of birth cannot be greater than todays date.'], 422);
        }

        $animal = new Animal([
            'name' => $name,
            'birth_date' => $birth_date,
            'photo' => $photo
        ]);

        $animal->saveOrFail();
        return response()->json($animal, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnimalRequest  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
