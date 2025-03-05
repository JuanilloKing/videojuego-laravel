<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Videojuegos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3 text-center">Titulo</th>
                                    <th class="px-6 py-3 text-center">Año</th>
                                    <th class="px-6 py-3 text-center">Desarrolladora</th>
                                    <th class="px-6 py-3 text-center">Distribuidora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $uniqueVideojuegos = [];
                                @endphp
                                @foreach ($videojuegos as $videojuego)
                                    @if (!in_array($videojuego->videojuego_id, $uniqueVideojuegos))
                                        @php
                                            $uniqueVideojuegos[] = $videojuego->id;
                                        @endphp
                                        <tr class="border-b dark:border-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-white">
                                                {{ $videojuego->titulo }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $videojuego->anyo }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $videojuego->desarrolladora->nombre }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $videojuego->desarrolladora->distribuidora->nombre }}
                                            </td>
                                            <td class="px-6 py-4 flex justify-center space-x-4">
                                                <a href="{{ route('videojuegos.tengo', $videojuego->id) }}"
                                                   class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">
                                                    Tengo
                                                </a>
                                                <a href="{{ route('videojuegos.notengo', $videojuego->id) }}"
                                                   class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">
                                                    No Tengo
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-center">
                <a href="{{ route('videojuegos.create') }}"
                   class="px-6 py-3 text-lg font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                    Crear un nuevo videojuego
                </a>
            </div>

        </div>
    </div>

</x-app-layout>