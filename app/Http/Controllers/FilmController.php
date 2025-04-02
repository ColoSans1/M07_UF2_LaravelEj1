<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        // Obtener películas desde la base de datos usando Eloquent
        $filmsDb = Film::all()->toArray();

        // Fusionar ambas fuentes de datos
        $allFilms = array_merge($jsonFilms, $filmsDb);

        // Evitar duplicados por título
        $uniqueFilms = [];
        foreach ($allFilms as $film) {
            $title = $film['title'] ?? null;
            if ($title && !isset($uniqueFilms[$title])) {
                $uniqueFilms[$title] = $film;
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
        return view('films.list', ["films" => $films, "title" => "Listado de todas las pelis"]);
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
                'title' => 'required|string|max:255',
                'year' => 'required|integer',
                'genre' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'duration' => 'required|integer',
                'img_url' => 'nullable|image|max:2048'
            ]);

            // Guardar la película en la base de datos usando Eloquent
            $film = new Film();
            $film->title = $request->title;
            $film->year = $request->year;
            $film->genre = $request->genre;
            $film->country = $request->country;
            $film->duration = $request->duration;
            $film->img_url = $request->hasFile('img_url') ? $request->file('img_url')->store('films', 'public') : null;
            $film->save();

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
        $films = Film::with('actors')->get();
        return response()->json($films);
    }

    /**
     * Listar todas las películas con sus actores en un formato personalizado
     */
    public function getFilmsWithActors()
    {
        $films = Film::with('actors')->get();
        
        $filmsWithActors = $films->map(function ($film) {
            return [
                'id' => $film->id,
                'title' => $film->title,
                'year' => $film->year,
                'genre' => $film->genre,
                'country' => $film->country,
                'duration' => $film->duration,
                'img_url' => $film->img_url,
                'created_at' => $film->created_at,
                'updated_at' => $film->updated_at,
                'actors' => $film->actors
            ];
        });

        return response()->json($filmsWithActors);
    }
}
