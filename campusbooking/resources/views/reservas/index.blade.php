@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reservas</h2>

        @can('crear reservas')
            <a href="{{ route('reservas.create') }}" class="btn btn-primary">
                Crear Reserva
            </a>
        @endcan
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Espacio</th>
                <th>Usuario</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->id }}</td>

                    <td>{{ $reserva->espacio->nombre }}</td>

                    <td>
                        @role('admin')
                            {{ $reserva->usuario->name }}
                        @else
                            Yo
                        @endrole
                    </td>

                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('Y-m-d H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('Y-m-d H:i') }}</td>

                    <td>{{ $reserva->motivo ?? '—' }}</td>

                    <td>{{ $reserva->estado }}</td>

                    <td>
                        @can('editar reservas')
                            <a href="{{ route('reservas.edit', $reserva) }}" 
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>
                        @endcan

                        @can('eliminar reservas')
                            <form action="{{ route('reservas.destroy', $reserva) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar reserva?')">
                                    Eliminar
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay reservas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reservas->links() }}
</div>
@endsection
