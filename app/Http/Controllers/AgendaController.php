<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function getPorAno(Request $request)
    {
        $date = Carbon::now()->subYear(1)->toDateString();
        $user = User::find(Auth::id());
        $animais_id = $user->animais()->pluck('animais.id');

        $vacinas = DB::table('vacinas')->where('data_aplicacao', '>=', $date)->whereIn('id_animal', $animais_id)->get();

        return response()->json($vacinas, 200);
    }
}
