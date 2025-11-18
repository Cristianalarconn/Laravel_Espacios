<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;

class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = Espacio::paginate(10);
        return view('espacios.index', compact('espacios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string|max:255',
        ]);

        Espacio::create($request->all());

        return redirect()->route('espacios.index')
            ->with('success', 'Espacio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Espacio $espacio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espacio $espacio)
    {
        return view('espacios.edit', compact('espacio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espacio $espacio)
    {
           $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string|max:255',
        ]);

        $espacio->update($request->all());

        return redirect()->route('espacios.index')
            ->with('success', 'Espacio actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espacio $espacio)
    {
       if ($espacio->reservas()->count() > 0) {
        return redirect()->back()->with('error', 'No puedes eliminar este espacio porque tiene reservas asociadas borralas y lueog eliminas');
    }

    $espacio->delete();

    return redirect()->route('espacios.index')->with('success', 'Espacio eliminado correctamente');
}
    }

