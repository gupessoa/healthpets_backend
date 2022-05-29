<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Procedimento;
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

Route::group(['middleware' => ['jwt.auth', 'api']], function (){
    Route::resource('animal', AnimalController::class, ['except' => ['create','edit']]);
    Route::prefix('animal')->group(function() {
        Route::post('/foto', [AnimalController::class, 'update_foto']);
    });

//    //Auth Rotes
//    Route::prefix('auth')->group(function(){
//        Route::get('/logout', [AuthController::class, 'logout']);
//        Route::get('/me', [AuthController::class, 'me']);
//        Route::get('/refresh', [AuthController::class, 'refresh']);
//        Route::delete('/delete', [AuthController::class, 'destroy']);
//    });
});
/*
Route::prefix('animal')->group(function(){
    Route::get('/', [AnimalController::class, 'index']);
    Route::get('/{id}', [AnimalController::class, 'show']);
    Route::post('/', [AnimalController::class, 'store']);
    Route::put('/update/{id}', [AnimalController::class, 'update']);
    Route::delete('/{id}', [AnimalController::class, 'delete']);
});*/

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
    Route::post('/forgot', [AuthController::class, 'forgotPassword']);
    Route::get('/reset', [AuthController::class, 'reset'])->name('password.reset');
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail']);
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
});

Route::resource('template', TemplateVacinaController::class, ['except' => ['create','edit']]);
Route::resource('consulta', ConsultaController::class, ['except' => ['create','edit', 'index']]);
Route::resource('local', LocalController::class, ['except' => ['create','edit']]);
Route::resource('procedimento', ProcedimentoController::class, ['except' => ['create','edit']]);
Route::resource('vacina', VacinaController::class, ['except' => ['create','edit', 'index']]);
Route::resource('categoria', CategoriaController::class, ['except' => ['create','edit']]);
Route::resource('subcategoria', SubcategoriaController::class, ['except' => ['create','edit']]);
Route::resource('info', InfoController::class, ['except' => ['create','edit', 'index']]);
Route::post('/vacina/{id}', [VacinaController::class, 'index']);
Route::post('/consulta/{id}', [ConsultaController::class, 'index']);
Route::resource('especie', EspecieController::class, ['except' => ['create','edit']]);
Route::resource('raca', RacaController::class, ['except' => ['create','edit']]);
Route::resource('diario', DiarioController::class, ['except' => ['create','edit', 'index']]);
Route::post('/diario/{id}', [DiarioController::class, 'getAllByAnimal']);
Route::post('/info/{id}', [InfoController::class, 'getByAnimal']);
Route::get('/especie/{id}/racas', [RacaController::class, 'getRacaByEspecie']);
//Route::get('/animal/{id}/user', [AnimalController::class, 'index']);
Route::get('/agenda', [AgendaController::class, 'getPorAno']);
//Protected Routes
Route::group(['middleware' => ['jwt.auth']], function (){
    //Auth Rotes

});
//teste

//Route::post('/animal/foto/', [AnimalController::class, 'foto']);

//Route::get('get/{filename}', [FilesController::class, 'getfile']);
//Route::get('file/{filename}', ['middleware' => ['signedurl'], function ($filename) {
//    return Image::make(storage_path('app/public/'.$filename))->response();
//}]);


