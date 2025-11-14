@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @can('crear espacios')
        <h2>Crear Espacio</h2>

        <form action="{{ route('espacios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <input type="text" name="tipo" class="form-control" value="{{ old('tipo') }}">
                @error('tipo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Capacidad</label>
                <input type="number" name="capacidad" class="form-control" min="1" value="{{ old('capacidad') }}">
                @error('capacidad') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
                @error('ubicacion') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('espacios.index') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    @else
        <div class="alert alert-danger">
            No tienes permiso para crear espacios.
        </div>
    @endcan

</div>
@endsection
