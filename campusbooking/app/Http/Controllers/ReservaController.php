<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Espacio;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $reservas = Reserva::with('usuario', 'espacio')->paginate(10);
        } else {
            $reservas = Reserva::where('user_id', Auth::id())
                               ->with('espacio')
                               ->paginate(10);
        }

        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $espacios = Espacio::all(); 
        return view('reservas.create', compact('espacios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'espacio_id' => 'required|exists:espacios,id',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'motivo' => 'nullable|string|max:500',
    ]);

    
    $overlap = Reserva::where('espacio_id', $request->espacio_id)
        ->where(function($q) use ($request) {
            $q->where('fecha_inicio', '<', $request->fecha_fin)
              ->where('fecha_fin', '>', $request->fecha_inicio);
        })
        ->exists();

    if ($overlap) {
        return back()
            ->withInput()
            ->withErrors(['fecha_inicio' => 'El espacio ya está reservado en ese rango de fechas/horas.']);
    }

    Reserva::create([
        'user_id' => Auth::id(),
        'espacio_id' => $request->espacio_id,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'motivo' => $request->motivo,
        'estado' => 'pendiente',
    ]);

    return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente');
}


public function edit(Reserva $reserva)
{
    if (!Auth::user()->hasRole('admin') && $reserva->user_id !== Auth::id()) {
        abort(403);
    }

    $espacios = Espacio::all();

    return view('reservas.edit', compact('reserva', 'espacios'));
}
    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, Reserva $reserva)
{
    if (!Auth::user()->hasRole('admin') && $reserva->user_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'espacio_id' => 'required|exists:espacios,id',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'motivo' => 'nullable|string|max:500',
    ]);

    $overlap = Reserva::where('espacio_id', $request->espacio_id)
        ->where('id', '!=', $reserva->id)
        ->where(function($q) use ($request) {
            $q->where('fecha_inicio', '<', $request->fecha_fin)
              ->where('fecha_fin', '>', $request->fecha_inicio);
        })
        ->exists();

    if ($overlap) {
        return back()
            ->withInput()
            ->withErrors(['fecha_inicio' => 'El espacio ya está reservado en ese rango de fechas/horas.']);
    }

    $reserva->update([
        'espacio_id' => $request->espacio_id,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'motivo' => $request->motivo,
    ]);

    return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        if (!Auth::user()->hasRole('admin') && $reserva->user_id !== Auth::id()) {
            abort(403);
        }

        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}