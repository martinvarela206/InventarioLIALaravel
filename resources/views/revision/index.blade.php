@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Revisión de Inventario</h1>

    <form action="{{ route('revision.index') }}" method="GET" class="mb-4">
        <div class="flex items-center">
            <input type="text" name="search" placeholder="Buscar por Nro LIA, Descripción o Ubicación..." value="{{ request('search') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('revision.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">Limpiar</a>
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
            
            // Focus back on input if it has value (simple UX improvement)
            if (searchInput.value) {
                searchInput.focus();
                // Move cursor to end
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
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-left">Ubicación Actual</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($elementos as $elemento)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer" onclick="window.location='{{ route('elementos.show', $elemento->nro_lia) }}?from=revision'">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $elemento->nro_lia }}</td>
                        <td class="py-3 px-6 text-left">{{ $elemento->descripcion }}</td>
                        <td class="py-3 px-6 text-left">
                            @if($elemento->ultimoMovimiento)
                                {{ $elemento->ultimoMovimiento->ubicacion }}
                                <span class="text-xs text-gray-500 block">({{ $elemento->ultimoMovimiento->fecha->format('Y-m-d') }})</span>
                            @else
                                <span class="text-gray-400">Sin movimientos</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
