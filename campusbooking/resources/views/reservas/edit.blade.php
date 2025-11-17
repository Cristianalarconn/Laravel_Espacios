@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Reserva</h2>

    <form action="{{ route('reservas.update', $reserva) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Espacio</label>
            <select name="espacio_id" class="form-control" required>
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}" {{ $reserva->espacio_id == $espacio->id ? 'selected' : '' }}>
                        {{ $espacio->nombre }}
                    </option>
                @endforeach
            </select>
            @error('espacio_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha y hora inicio</label>
            <input type="datetime-local" name="fecha_inicio" class="form-control"
                   value="{{ old('fecha_inicio', \Carbon\Carbon::parse($reserva->fecha_inicio)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha_inicio') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha y hora fin</label>
            <input type="datetime-local" name="fecha_fin" class="form-control"
                   value="{{ old('fecha_fin', \Carbon\Carbon::parse($reserva->fecha_fin)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha_fin') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Motivo (opcional)</label>
            <textarea name="motivo" class="form-control">{{ old('motivo', $reserva->motivo) }}</textarea>
            @error('motivo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-warning">Actualizar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
