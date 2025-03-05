<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            editar videojuego
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('videojuegos.update', $videojuego) }}" class="max-w-sm mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <x-input-label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        titulo
                    </x-input-label>
                    <x-text-input name="titulo" type="text" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('titulo', $videojuego->titulo)" />
                    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-input-label for="anyo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        año
                    </x-input-label>
                    <x-text-input name="anyo" type="text" id="anyo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('anyo', $videojuego->anyo)" />
                    <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="desarrolladora_id" :value="'desarrolladora del videojuego'"/>
                        <select id="desarrolladora_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500rounded-md shadow-sm block mt-1 w-full" name="desarrolladora_id" required>
                            @foreach ($desarrolladoras as $desarrolladora)
                                <option value="{{ $desarrolladora->id }}"{{ old('desarrolladora_id') == $desarrolladora->id ? 'selected' : '' }}>
                                {{ $desarrolladora->nombre }}
                                </option>
                            @endforeach
                        </select>
                    <x-input-error :messages="$errors->get('desarrolladora_id')" class="mt-2" />
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>