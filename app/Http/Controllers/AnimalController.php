<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function show(int $id)
    {
        // TODO implementar a busca apenas nos animais cadastrados por este usuário
        return response()->json(Animal::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnimalRequest  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, int $id)
    {
        $animal = Animal::find($id);

        $animal->name = $request->name;
        $animal->birth_date = $request->birth_date;
        $animal->photo = $request->photo;

        return response()->json($animal->update(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return response()->json(['message' => 'Successfully deleted animal.'], 200);
    }

    public function shareAnimal(int $id_animal)
    {
        $codigo = Hash::make($id_animal.''.(\Carbon\Carbon::now()));
        DB::table('compartilhamento')
            ->insert([
                'codigo' => $codigo,
                'validade' => \Carbon\Carbon::now()->addMinutes(60),
                'ativo' => 's',
            ]);

        return response()->json(['codigo' => $codigo], 200);
    }

    public function saveSharedAnimal(int $id_animal, string $codigo)
    {
        $codigo = DB::table('compartilhamento')->where('codigo', $codigo)->get()->ativo ;
        if($codigo['ativo'] == 'n' || \Carbon\Carbon::now()->greaterThan($codigo['created_at'])){
            return response()->json(['error' => 'Código inválido ou Tempo de compartilhamento expirado.'], 422);
        }
        DB::table('compartilhamento')->update(['ativo'=>'n'])->where('codigo', $codigo);
        $animal = Animal::find($id_animal);
        $animal->users()->attach(Auth::id(), ['owner' => 'n']);

        return response()->json(['message' => 'Animal compartilhado com sucesso'], 200);
    }
}
