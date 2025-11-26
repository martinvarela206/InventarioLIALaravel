@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold">Revisión de Inventario</h1>
            <p class="text-sm text-gray-600">Explora y verifica la ubicación de los elementos</p>
        </div>
    </div>

    <form action="{{ route('revision.index') }}" method="GET" class="mb-6">
        <div class="flex gap-3 items-center">
            <input type="text" name="search" placeholder="Buscar por Nro LIA, Descripción o Ubicación..." value="{{ request('search') }}" class="w-full rounded-lg border border-gray-200 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#dba800]" />
            <button type="submit" class="bg-[#dba800] hover:bg-[#fbc101] text-[#111] font-semibold py-2 px-4 rounded shadow">Buscar</button>
            @if(request('search'))
                <a href="{{ route('revision.index') }}" class="text-gray-600 hover:text-gray-800">Limpiar</a>
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
                <tr class="bg-amber-400 text-amber-900 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nro LIA</th>
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-left">Ubicación Actual</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 text-sm font-light">
                @foreach($elementos as $elemento)
                    <tr class="odd:bg-amber-50 even:bg-amber-100 border-b border-gray-300 hover:bg-amber-200 cursor-pointer" onclick="window.location='{{ route('elementos.show', $elemento->nro_lia) }}?from=revision'">
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
