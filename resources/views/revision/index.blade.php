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
        @if(request('cpus'))
            <input type="hidden" name="cpus" value="1">
        @endif
        @if(request('gb'))
            <input type="hidden" name="gb" value="{{ request('gb') }}">
        @endif
        @if(request('prestado'))
            <input type="hidden" name="prestado" value="1">
        @endif
    </form>

    <div class="flex justify-end gap-4 mb-6 items-center">
        <form action="{{ route('revision.index') }}" method="GET" class="flex items-center">
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            @if(request('cpus')) <input type="hidden" name="cpus" value="{{ request('cpus') }}"> @endif
            @if(request('prestado')) <input type="hidden" name="prestado" value="{{ request('prestado') }}"> @endif
            
            <div class="flex items-center rounded-full border {{ request('gb') ? 'bg-amber-700 border-amber-700 text-white' : 'border-amber-700 text-amber-700 hover:bg-amber-50' }} overflow-hidden transition-colors">
                <span class="pl-4 pr-1 text-sm font-semibold">GB</span>
                <input 
                    type="number" 
                    name="gb" 
                    value="{{ request('gb') }}" 
                    class="w-16 py-1 px-1 bg-transparent border-none focus:ring-0 text-sm font-semibold placeholder-amber-700/50 {{ request('gb') ? 'text-white placeholder-white/70' : 'text-amber-700' }} focus:outline-none"
                    placeholder="#"
                    onchange="this.form.submit()"
                >
                @if(request('gb'))
                    <a href="{{ route('revision.index', array_merge(request()->except('gb'))) }}" class="pr-3 pl-1 hover:text-amber-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('revision.index', array_merge(request()->all(), ['cpus' => !request()->boolean('cpus')])) }}" 
           class="px-4 py-1 rounded-full border border-amber-700 text-sm font-semibold transition-colors {{ request()->boolean('cpus') ? 'bg-amber-700 text-white' : 'text-amber-700 hover:bg-amber-50' }}">
           CPUs
        </a>
        <a href="{{ route('revision.index', array_merge(request()->all(), ['prestado' => !request()->boolean('prestado')])) }}" 
           class="px-4 py-1 rounded-full border border-amber-700 text-sm font-semibold transition-colors {{ request()->boolean('prestado') ? 'bg-amber-700 text-white' : 'text-amber-700 hover:bg-amber-50' }}">
           Prestado
        </a>
    </div>

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
            <tbody class="text-gray-900 text-sm font-medium">
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

    <div class="my-6">
        {{ $elementos->links() }}
    </div>
@endsection
