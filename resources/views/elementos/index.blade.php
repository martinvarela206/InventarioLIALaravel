@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Lista de Elementos</h1>
        @can('write-data')
            <a href="{{ route('elementos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Añadir Elemento</a>
        @endcan
    </div>

    <form action="{{ route('elementos.index') }}" method="GET" class="mb-4">
        <div class="flex items-center">
            <input type="text" name="search" placeholder="Buscar por Nro LIA, UNSJ, Tipo o Descripción..." value="{{ request('search') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('elementos.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">Limpiar</a>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const searchForm = searchInput.closest('form');
            let timeout = null;

            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                if (this.value.length >= 2) {
                    timeout = setTimeout(() => {
                        searchForm.submit();
                    }, 600);
                }
            });

            if (searchInput.value) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        });
    </script>

    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nro LIA</th>
                    <th class="py-3 px-6 text-left">Nro UNSJ</th>
                    <th class="py-3 px-6 text-left">Tipo</th>
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-center">Cantidad</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($elementos as $elemento)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer" onclick="window.location='{{ route('elementos.show', $elemento->nro_lia) }}?from=elementos'">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $elemento->nro_lia }}</td>
                        <td class="py-3 px-6 text-left">{{ $elemento->nro_unsj }}</td>
                        <td class="py-3 px-6 text-left">{{ $elemento->tipo }}</td>
                        <td class="py-3 px-6 text-left">
                            {{ $elemento->descripcion }}
                        </td>
                        <td class="py-3 px-6 text-center">{{ $elemento->cantidad }}</td>
                        <td class="py-3 px-6 text-center" onclick="event.stopPropagation()">
                            <div class="flex item-center justify-center">
                                @can('write-data')
                                    <a href="{{ route('elementos.edit', $elemento->nro_lia) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                @endcan
                                @can('delete-data')
                                    <form action="{{ route('elementos.destroy', $elemento->nro_lia) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este elemento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
