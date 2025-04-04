<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
ISSUE 1 
*/

// Ruta para obtener el usuario autenticado (usando Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/actors', [ActorController::class, 'listActorsWithFilms']);

// Rutas relacionadas con las películas
Route::get('/films', [FilmController::class, 'listFilmsWithActors']);  // Ruta para listar todas las películas con sus actores

// Rutas relacionadas con los actores
Route::delete('/actors/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');  // Eliminar un actor por ID
