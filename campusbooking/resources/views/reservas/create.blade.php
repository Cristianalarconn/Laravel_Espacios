@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Crear Reserva</h2>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Espacio</label>
            <select name="espacio_id" class="form-control" required>
                <option value="">Seleccione un espacio</option>
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}">
                        {{ $espacio->nombre }} (Cap: {{ $espacio->capacidad }})
                    </option>
                @endforeach
            </select>
            @error('espacio_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha y hora inicio</label>
            <input type="datetime-local" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
            @error('fecha_inicio') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha y hora fin</label>
            <input type="datetime-local" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
            @error('fecha_fin') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Motivo (opcional)</label>
            <textarea name="motivo" class="form-control">{{ old('motivo') }}</textarea>
            @error('motivo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
