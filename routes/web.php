<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. 
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo 
| que contiene el grupo de middleware "web". ¡Ahora crea algo increíble!
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
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/byDecade', [ActorController::class, 'listByDecade'])->name('actors.byDecade');
Route::get('/actors/count', [ActorController::class, 'count'])->name('actors.count');

Route::get('/films', [FilmController::class, 'listFilms'])->name('films.list');
