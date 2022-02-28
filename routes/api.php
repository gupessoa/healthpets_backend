<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', function(){
    return response()->json(['status' => 'Online'], 200);
});

//Public Rotes
Route::prefix('auth')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::delete('/delete', [AuthController::class, 'destroy']);
});

Route::resource('animal', AnimalController::class, ['except' => ['create','edit']]);
Route::resource('animal.vacina', VacinaController::class, ['except' => ['create','edit']]);
Route::resource('especie', EspecieController::class, ['except' => ['create','edit']]);
Route::resource('raca', RacaController::class, ['except' => ['create','edit']]);

//Protected Routes
Route::group(['middleware' => ['jwt.auth']], function (){
    //Auth Rotes

});


