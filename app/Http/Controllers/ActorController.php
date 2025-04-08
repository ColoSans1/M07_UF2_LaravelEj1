<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    // Mostrar todos los actores
    public function index()
    {
        $actors = Actor::all(); 
        return view('actors.index', compact('actors'));
    }

    // Filtrar actores por década
    public function listByDecade(Request $request)
    {
        $decade = $request->input('decade');

        if (!in_array($decade, ['1980', '1990', '2000', '2010', '2020'])) {
            return redirect()->route('actors.index')->with('error', 'Década no válida.');
        }

        $startYear = $decade . '-01-01';
        $endYear = (intval($decade) + 9) . '-12-31';

        $actors = Actor::whereBetween('birthdate', [$startYear, $endYear])->get();

        return view('actors.list_by_decade', compact('actors'));
    }

    // Contar actores
    public function count()
    {
        $actorCount = Actor::count();
        return view('actors.count', compact('actorCount'));
    }

    // Eliminar un actor por ID
    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return redirect()->route('actors.index')->with('success', 'Actor eliminado correctamente.');
    }

    // Listar actores con sus películas (API REST para FR2)
    public function listActorsWithFilms()
    {
        $actors = Actor::with('films')->get();

        return response()->json($actors);
    }
}
