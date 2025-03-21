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
        
        // Verificamos que la década sea válida
        if (!in_array($decade, ['1980', '1990', '2000', '2010', '2020'])) {
            return redirect()->route('actors.index')->with('error', 'Decade not valid.');
        }
        
        // Calcular el rango de años para la década seleccionada
        $startYear = $decade . '-01-01';  // Año de inicio de la década
        $endYear = ($decade + 9) . '-12-31';  // Año de fin de la década

        // Buscar actores nacidos en el rango de años de la década seleccionada
        $actors = Actor::whereBetween('birthdate', [$startYear, $endYear])->get();

        return view('actors.list_by_decade', compact('actors'));
    }

    // Contar actores
    public function count()
    {
        $actorCount = Actor::count();
        return view('actors.count', compact('actorCount'));
    }

    /**
     * Eliminar un actor por su ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);
    
        if (!$actor) {
            return redirect()->route('actors.index')->with('error', 'Actor no encontrado.');
        }
    
        // Eliminar el actor
        $actor->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('actors.index')->with('success', 'Actor eliminado correctamente.');
    }
    
}
