<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Aplica el middleware 'year' al grupo de rutas relacionadas con las películas
Route::middleware('year')->group(function() {
    Route::group(['prefix' => 'filmout'], function() {
        // Rutas con el prefijo "filmout"
        Route::get('oldFilms/{year?}', [FilmController::class, 'listOldFilms'])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, 'listNewFilms'])->name('newFilms');
        Route::get('films/{year?}/{genre?}', [FilmController::class, 'listFilms'])->name('listFilms');
    });

    // Ruta para contar películas
    Route::get('/countFilms', [FilmController::class, 'countFilms'])->name('countFilms');

    // Ruta para obtener películas por año
    Route::get('filmsByYear/{year}', [FilmController::class, 'listFilmsByYear'])->name('filmsByYear');

    // Ruta para obtener películas por género
    Route::get('filmsByGenre/{genre}', [FilmController::class, 'listFilmsByGenre'])->name('filmsByGenre');
});

// Rutas que no necesitan validación de año
Route::get('/sortFilms', [FilmController::class, 'sortFilms']);

Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films/store', [FilmController::class, 'store'])->name('films.store');
