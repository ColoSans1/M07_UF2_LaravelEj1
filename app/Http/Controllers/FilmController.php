<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    // Método para contar el total de películas
    public function countFilms()
    {
        $films = $this->readFilms();
        $filmsCount = count($films);

        return view('countFilms', ['filmCount' => $filmsCount]);  // Cambié 'count' a 'filmCount'
    }

    /**
     * Leer las películas desde el almacenamiento
     */
    public static function readFilms(): array {
        // Obtener el contenido del archivo JSON
        $filmsJson = Storage::disk('public')->get('films.json');

        // Decodificar el JSON a un array
        $films = json_decode($filmsJson, true);

        return $films;
    }

    /**
     * Listar las películas más antiguas que el año de entrada
     * Si no se proporciona un año, se utilizará el 2000 como criterio
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }

        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    /**
     * Listar las películas más nuevas que el año de entrada
     * Si no se proporciona un año, se utilizará el 2000 como criterio
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }

        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    /**
     * Listar las películas por año (ruta filmsByYear/{year})
     */
    public function listFilmsByYear($year)
    {
        $films_filtered = [];
        $title = "Listado de Pelis del Año $year";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] == $year) {
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Listar las películas por género (ruta filmsByGenre/{genre})
     */
    public function listFilmsByGenre($genre)
    {
        $films_filtered = [];
        $title = "Listado de Pelis del Género $genre";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if (strtolower($film['genre']) == strtolower($genre)) {
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Lista TODAS las películas o filtra por año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        // Si no se especifican ni el año ni el género, se muestran todas las películas
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        // Filtrar según año o género
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de pelis filtrado por año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de pelis filtrado por categoría";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de pelis filtrado por categoría y año";
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortFilms()
    {
        $films = $this->readFilms();

        usort($films, function($a, $b) {
            return $b['year'] - $a['year']; 
        });

        return view('films.list', ['films' => $films, 'title' => 'Películas Ordenadas por Año (Más Nuevo a Más Antiguo)']);
    }
}
