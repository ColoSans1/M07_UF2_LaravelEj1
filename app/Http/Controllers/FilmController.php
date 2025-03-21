<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Film; // Importamos el modelo de base de datos

class FilmController extends Controller
{
    // Método para contar el total de películas
    public function countFilms()
    {
        $films = $this->readFilms();
        $filmsCount = count($films);

        return view('countFilms', ['filmCount' => $filmsCount]);
    }

    /**
     * Leer las películas desde el JSON y la base de datos
     */
    public static function readFilms(): array {
        // Obtener películas desde el JSON
        $filmsJson = Storage::disk('public')->get('films.json');
        $films = json_decode($filmsJson, true) ?? [];

        // Obtener películas desde la base de datos
        $filmsDb = Film::all()->toArray(); // Convertir a array para fusionar

        // Fusionar ambas fuentes de datos
        return array_merge($films, $filmsDb);
    }

    /**
     * Listar TODAS las películas (desde JSON y BD)
     */
    public function listFilms()
    {
        $films = $this->readFilms();
        return view('films.list', ["films" => $films, "title" => "Listado de todas las pelis"]);
    }

    /**
     * Listar las películas más antiguas que el año de entrada
     */
    public function listOldFilms($year = 2000)
    {        
        $films = $this->readFilms();
        $old_films = array_filter($films, fn($film) => $film['year'] < $year);

        return view('films.list', ["films" => $old_films, "title" => "Pelis Antiguas (Antes de $year)"]);
    }

    /**
     * Listar las películas más nuevas que el año de entrada
     */
    public function listNewFilms($year = 2000)
    {
        $films = $this->readFilms();
        $new_films = array_filter($films, fn($film) => $film['year'] >= $year);

        return view('films.list', ["films" => $new_films, "title" => "Pelis Nuevas (Después de $year)"]);
    }

    /**
     * Listar las películas ordenadas por año (más recientes primero)
     */
    public function sortFilms()
    {
        $films = $this->readFilms();
        usort($films, fn($a, $b) => $b['year'] - $a['year']);

        return view('films.list', ['films' => $films, 'title' => 'Películas Ordenadas por Año']);
    }
}
