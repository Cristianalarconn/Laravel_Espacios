@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Espacios</h2>
        <a href="{{ route('espacios.create') }}" class="btn btn-primary">Crear Espacio</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Capacidad</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($espacios as $espacio)
                <tr>
                    <td>{{ $espacio->id }}</td>
                    <td>{{ $espacio->nombre }}</td>
                    <td>{{ $espacio->tipo }}</td>
                    <td>{{ $espacio->capacidad }}</td>
                    <td>{{ $espacio->ubicacion }}</td>
                    <td>
                        <a href="{{ route('espacios.edit', $espacio) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('espacios.destroy', $espacio) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este espacio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay espacios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $espacios->links() }}

</div>
@endsection
