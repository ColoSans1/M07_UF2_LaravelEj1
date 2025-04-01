<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Film;

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
    protected function readFilms(): array
    {
        // Obtener películas desde el JSON
        $jsonFilms = [];
        if (Storage::disk('public')->exists('films.json')) {
            $filmsJson = Storage::disk('public')->get('films.json');
            $jsonFilms = json_decode($filmsJson, true) ?? [];
        }

        // Obtener películas desde la base de datos usando QueryBuilder
        $filmsDb = DB::table('films')->get();

        // Convertir los objetos de la base de datos a arrays para fusionarlos con JSON
        $filmsDbArray = json_decode(json_encode($filmsDb), true);

        // Fusionar ambas fuentes de datos
        $allFilms = array_merge($jsonFilms, $filmsDbArray);

        // Evitar duplicados por nombre
        $uniqueFilms = [];
        foreach ($allFilms as $film) {
            $name = $film['name'] ?? $film['title'] ?? null;
            if ($name && !isset($uniqueFilms[$name])) {
                $uniqueFilms[$name] = $film;
            }
        }

        return array_values($uniqueFilms);
    }

    /**
     * Listar TODAS las películas (desde JSON y BD)
     */
    public function listFilms()
    {
        $films = $this->readFilms();
        return view('films.list', data: ["films" => $films, "title" => "Listado de todas las pelis"]);
    }

    /**
     * Listar las películas más antiguas que el año de entrada
     */
    public function listOldFilms($year = 2000)
    {
        $films = $this->readFilms();
        $old_films = array_filter($films, fn($film) => ($film['year'] ?? 0) < $year);

        return view('films.list', ["films" => $old_films, "title" => "Pelis Antiguas (Antes de $year)"]);
    }

    /**
     * Listar las películas más nuevas que el año de entrada
     */
    public function listNewFilms($year = 2000)
    {
        $films = $this->readFilms();
        $new_films = array_filter($films, fn($film) => ($film['year'] ?? 0) >= $year);

        return view('films.list', ["films" => $new_films, "title" => "Pelis Nuevas (Después de $year)"]);
    }

    /**
     * Listar las películas ordenadas por año (más recientes primero)
     */
    public function sortFilms()
    {
        $films = $this->readFilms();
        usort($films, fn($a, $b) => ($b['year'] ?? 0) - ($a['year'] ?? 0));

        return view('films.list', ['films' => $films, 'title' => 'Películas Ordenadas por Año']);
    }

    /**
     * Mostrar el formulario para crear una nueva película
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Guardar una nueva película en la base de datos
     */
    public function store(Request $request)
    {
        try {
            // Validación de datos
            $request->validate([
                'name' => 'required|string|max:255',
                'year' => 'required|integer',
                'genre' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'duration' => 'required|integer',
                'img_url' => 'nullable|image|max:2048'
            ]);

            // Guardar la película en la base de datos usando QueryBuilder
            $filmId = DB::table('films')->insertGetId([
                'name' => $request->name,
                'year' => $request->year,
                'genre' => $request->genre,
                'country' => $request->country,
                'duration' => $request->duration,
                'img_url' => $request->hasFile('img_url') ? $request->file('img_url')->store('films', 'public') : null,
            ]);

            return redirect()->route('films.list')->with('success', 'Película añadida correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al añadir la película: ' . $e->getMessage());
        }
    }

    /**
     * Listar todas las películas con sus actores (API REST para FR1)
     */
    public function listFilmsWithActors()
    {
        // Obtener todas las películas desde la base de datos
        $films = DB::table('films')->get();

        // Para cada película, obtener sus actores
        $filmsWithActors = $films->map(function ($film) {
            $actors = DB::table('films_actors')
                ->where('film_id', $film->id)
                ->join('actors', 'films_actors.actor_id', '=', 'actors.id')
                ->select('actors.*')
                ->get();

            return [
                'id' => $film->id,
                'name' => $film->name,
                'year' => $film->year,
                'genre' => $film->genre,
                'country' => $film->country,
                'duration' => $film->duration,
                'img_url' => $film->img_url,
                'created_at' => $film->created_at,
                'updated_at' => $film->updated_at,
                'actors' => $actors
            ];
        });

        // Devolver el resultado como JSON
        return response()->json($filmsWithActors);
    }

    /**
     * Método existente para listar películas (puede ser usado para otras APIs)
     */
    public function index()
    {
        $films = Film::all();
        return response()->json($films);
    }
}