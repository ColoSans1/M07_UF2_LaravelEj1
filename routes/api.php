<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;


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

/*
ISSUS 1 
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/films', [FilmController::class, 'index']);


Route::delete('/actors/{id}', [ActorController::class, 'destroy']);
Route::delete('/actors/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');
Route::get('/films', [FilmController::class, 'getFilmsWithActors']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
