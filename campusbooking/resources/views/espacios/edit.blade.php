@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Espacio</h2>

    <form action="{{ route('espacios.update', $espacio) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $espacio->nombre) }}">
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ old('tipo', $espacio->tipo) }}">
            @error('tipo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" min="1" value="{{ old('capacidad', $espacio->capacidad) }}">
            @error('capacidad') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $espacio->ubicacion) }}">
            @error('ubicacion') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('espacios.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>
</div>
@endsection
