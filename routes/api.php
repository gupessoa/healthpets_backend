<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
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
    return response()->json(['status' => 'Connected'], 200);
});

Route::prefix('auth')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::delete('/delete', [AuthController::class, 'destroy']);
});

Route::prefix('animal')->group(function(){
    Route::get('/', [AnimalController::class, 'index']);
    Route::post('/', [AnimalController::class, 'store']);
    Route::get('/get/{id}', [AnimalController::class, 'show']);
    Route::put('/{id}', [AnimalController::class, 'update']);
    Route::delete('/delete', [AnimalController::class, 'destroy']);
});

Route::prefix('vacina')->group(function(){
    Route::get('/', [AnimalController::class, 'index']);
    Route::post('/', [AnimalController::class, 'store']);
    Route::get('/get/{id}', [AnimalController::class, 'show']);
    Route::put('/{id}', [AnimalController::class, 'update']);
    Route::delete('/delete', [AnimalController::class, 'destroy']);
});