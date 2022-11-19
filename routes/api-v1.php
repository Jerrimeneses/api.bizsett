<?php

use App\Http\Controllers\Api\BuzonController;
use App\Http\Controllers\Api\CiudadeController;
use App\Http\Controllers\Api\ComentarioController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\EmpleoController;
use App\Http\Controllers\Api\EmprendimientoController;
use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\InversionistaController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MultimediaController;
use App\Http\Controllers\Api\NotificacioneController;
use App\Http\Controllers\Api\PerfilController;
use App\Http\Controllers\Api\PublicacioneController;
use App\Http\Controllers\Api\ReaccioneController;
use App\Http\Controllers\Api\TipodocumentoController;
use App\Http\Controllers\Api\TiponotificacioneController;
use App\Http\Controllers\Api\TipopersonaController;
use App\Http\Controllers\Api\UserController;

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



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('buzons', [BuzonController::class, 'store'])->name('api.v1.buzons.store');

// Route::get('buzons', [BuzonController::class, 'index'])->name('api.v1.buzons.index');


Route::post('login', [LoginController::class, 'login'])->name('api.v1.login');

Route::get('logout', [LoginController::class, 'logout']) ->name('api.v1.logout');

Route::put('foto/{user}', [PerfilController::class, 'foto']) ->name('api.v1.foto');

Route::apiResource('users', UserController::class)->names('api.v1.users');

Route::apiResource('emprendimientos', EmprendimientoController::class)->names('api.v1.emprendimientos');

Route::apiResource('inversionistas', InversionistaController::class)->names('api.v1.inversionistas');

Route::apiResource('buzons', BuzonController::class)->names('api.v1.buzons');

Route::apiResource('reacciones', ReaccioneController::class)->names('api.v1.reacciones');

Route::apiResource('comentarios', ComentarioController::class)->names('api.v1.comentarios');

Route::apiResource('followers', FollowerController::class)->names('api.v1.followers');

Route::apiResource('ciudades', CiudadeController::class)->names('api.v1.ciudades');

Route::apiResource('departamentos', DepartamentoController::class)->names('api.v1.departamentos');

Route::apiResource('notificaciones', NotificacioneController::class)->names('api.v1.notificaciones');

Route::apiResource('tipopersonas', TipopersonaController::class)->names('api.v1.tipopersonas');

Route::apiResource('tipodocumentos', TipodocumentoController::class)->names('api.v1.tipodocumentos');

Route::apiResource('tiponotificaciones', TiponotificacioneController::class)->names('api.v1.tiponotificaciones');


//Publicaciones Api

Route::delete('publicaciones/{publicacione}', [PublicacioneController::class, 'destroy']) ->name('api.v1.destroy');

Route::get('publicaciones', [PublicacioneController::class, 'index']) ->name('api.v1.index');

Route::get('publicaciones/{id}', [PublicacioneController::class, 'show']) ->name('api.v1.show');

Route::put('publicaciones/{publicacione}', [PublicacioneController::class, 'update']) ->name('api.v1.update');

Route::put('publicaciones/editar/{publicacione}/{id}', [PublicacioneController::class, 'editar']) ->name('api.v1.editar');

Route::post('publicaciones/crear/{id}', [PublicacioneController::class, 'crear']) ->name('api.v1.crear');



//Empleos Api
Route::get('empleos', [EmpleoController::class, 'index']) ->name('api.v1.empleos.index');

Route::get('empleos/{id}', [EmpleoController::class, 'show']) ->name('api.v1.empleos.show');

Route::put('empleos/{empleo}', [EmpleoController::class, 'update']) ->name('api.v1.empleos.update');

Route::post('empleos/crear/{user}/{emprendimiento}', [EmpleoController::class, 'crear']) ->name('api.v1.empleos.crear');

Route::post('empleos', [EmpleoController::class, 'store']) ->name('api.v1.empleos.store');

Route::delete('empleos/{empleo}', [EmpleoController::class, 'destroy']) ->name('api.v1.empleos.destroy');

//Route::apiResource('publicaciones', PublicacioneController::class)->names('api.v1.publicaciones');

//Route::apiResource('empleos', EmpleoController::class)->names('api.v1.empleos');


