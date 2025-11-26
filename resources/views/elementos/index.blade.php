@extends('layouts.app')

@section('content')
    <h2 class="text-center mt-10 text-[#dba800] text-2xl font-semibold">Lista de Elementos</h2>
    
    @can('write-data')
        <a href="{{ route('elementos.create') }}" class="inline-block mt-5 ml-[10%] bg-[#dba800] text-[#111] px-5 py-2 rounded font-semibold transition-colors duration-200 hover:bg-[#fbc101] no-underline border-2 border-[#dba800] hover:border-[#fbc101]">Añadir Elemento</a>
    @endcan

    <form action="{{ route('elementos.index') }}" method="GET" class="w-4/5 mx-auto mt-6">
        <div class="flex gap-3 items-center">
            <input type="text" name="search" placeholder="Buscar por Nro LIA, Tipo o Descripción..." value="{{ request('search') }}" class="w-full rounded-lg border border-gray-200 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#dba800]" />
            <button type="submit" class="bg-[#dba800] hover:bg-[#fbc101] text-[#111] font-semibold py-2 px-4 rounded shadow border-2 border-[#dba800] hover:border-[#fbc101]">Buscar</button>
            @if(request('search'))
                <a href="{{ route('elementos.index') }}" class="text-gray-600 hover:text-gray-800">Limpiar</a>
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

    <div class="flex justify-end gap-4 w-4/5 mx-auto mt-4 items-center">
        <form action="{{ route('elementos.index') }}" method="GET" class="flex items-center">
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
                    <a href="{{ route('elementos.index', array_merge(request()->except('gb'))) }}" class="pr-3 pl-1 hover:text-amber-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('elementos.index', array_merge(request()->all(), ['cpus' => !request()->boolean('cpus')])) }}" 
           class="px-4 py-1 rounded-full border border-amber-700 text-sm font-semibold transition-colors {{ request()->boolean('cpus') ? 'bg-amber-700 text-white' : 'text-amber-700 hover:bg-amber-50' }}">
           CPUs
        </a>
        <a href="{{ route('elementos.index', array_merge(request()->all(), ['prestado' => !request()->boolean('prestado')])) }}" 
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

            if (searchInput.value) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        });
    </script>

    <div class="w-4/5 mx-auto mt-8 shadow-md bg-white rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-amber-400 text-amber-900 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nro LIA</th>
                    <!-- <th class="py-3 px-6 text-left">Nro UNSJ</th> -->
                    <th class="py-3 px-6 text-left">Tipo</th>
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-left">Cantidad</th>
                    <th class="py-3 px-6 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 text-sm font-medium">
                @foreach($elementos as $elemento)
                    <tr class="odd:bg-amber-50 even:bg-amber-100 border-b border-gray-300 hover:bg-amber-200 cursor-pointer" onclick="window.location='{{ route('elementos.show', $elemento->nro_lia) }}'">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $elemento->nro_lia }}</td>
                        <!-- <td class="py-3 px-6 text-left">{{ $elemento->nro_unsj }}</td> -->
                        <td class="py-3 px-6 text-left">{{ $elemento->tipo }}</td>
                        <td class="py-3 px-6 text-left">
                            {{ $elemento->descripcion }}
                        </td>
                        <td class="py-3 px-6 text-left">{{ $elemento->cantidad }}</td>
                        <td class="py-3 px-6 text-left" onclick="event.stopPropagation()">
                            <div class="flex items-center justify-center gap-1">
                                @can('write-data')
                                    <a href="{{ route('elementos.edit', $elemento->nro_lia) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Modificar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                @endcan
                                @can('delete-data')
                                    <form action="{{ route('elementos.destroy', $elemento->nro_lia) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este elemento?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Eliminar">
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

    <div class="w-4/5 mx-auto mt-4">
        {{ $elementos->links() }}
    </div>
@endsection
