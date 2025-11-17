<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
               
                <a href="{{ route('reservas.index') }}"
                   class="bg-white p-6 shadow rounded-lg hover:bg-gray-100 transition">
                    <h3 class="text-lg font-semibold text-gray-800">Reservas</h3>
                    <p class="text-gray-600">Administrar todas las reservas.</p>
                </a>

             
                <a href="{{ route('espacios.index') }}"
                   class="bg-white p-6 shadow rounded-lg hover:bg-gray-100 transition">
                    <h3 class="text-lg font-semibold text-gray-800">Espacios</h3>
                    <p class="text-gray-600">Ver y gestionar los espacios.</p>
                </a>

               
                @can('manage users')
                <a href="{{ route('users.index') }}"
                   class="bg-white p-6 shadow rounded-lg hover:bg-gray-100 transition">
                    <h3 class="text-lg font-semibold text-gray-800">Usuarios</h3>
                    <p class="text-gray-600">Administración de usuarios.</p>
                </a>
                @endcan

            </div>

            <div class="mt-6 bg-white shadow-sm rounded-lg p-6">
                <p class="text-gray-900">¡Bienvenido al sistema de reservas!</p>
            </div>

        </div>
    </div>
</x-app-layout>

