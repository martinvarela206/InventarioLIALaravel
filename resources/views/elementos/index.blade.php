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

    <div class="w-4/5 mx-auto mt-8 shadow-md bg-white rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#fbc101] text-[#111]">
                    <th class="py-3 px-5 text-left font-semibold tracking-wide">Nro LIA</th>
                    <!-- <th class="py-3 px-5 text-left font-semibold tracking-wide">Nro UNSJ</th> -->
                    <th class="py-3 px-5 text-left font-semibold tracking-wide">Tipo</th>
                    <th class="py-3 px-5 text-left font-semibold tracking-wide">Descripción</th>
                    <th class="py-3 px-5 text-left font-semibold tracking-wide">Cantidad</th>
                    <th class="py-3 px-5 text-left font-semibold tracking-wide">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($elementos as $elemento)
                    <tr class="hover:bg-[#fcd34d] transition-colors border-b border-gray-200 last:border-b-0 cursor-pointer" onclick="window.location='{{ route('elementos.show', $elemento->nro_lia) }}'">
                        <td class="py-3 px-5 text-[#111]">{{ $elemento->nro_lia }}</td>
                        <!-- <td class="py-3 px-5 text-[#111]">{{ $elemento->nro_unsj }}</td> -->
                        <td class="py-3 px-5 text-[#111]">{{ $elemento->tipo }}</td>
                        <td class="py-3 px-5 text-[#111] font-medium">
                            {{ $elemento->descripcion }}
                        </td>
                        <td class="py-3 px-5 text-[#111]">{{ $elemento->cantidad }}</td>
                        <td class="py-3 px-5" onclick="event.stopPropagation()">
                            <div class="flex items-center gap-1">
                                @can('write-data')
                                    <a href="{{ route('elementos.edit', $elemento->nro_lia) }}" class="bg-[#dba800] text-[#111] border-2 border-[#dba800] rounded px-3.5 py-1.5 cursor-pointer text-sm font-medium transition-colors duration-200 hover:bg-[#fbc101] hover:border-[#fbc101]">
                                        Modificar
                                    </a>
                                @endcan
                                @can('delete-data')
                                    <form action="{{ route('elementos.destroy', $elemento->nro_lia) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este elemento?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-[#c62828] text-white border-2 border-[#c62828] rounded px-3.5 py-1.5 cursor-pointer text-sm font-medium transition-colors duration-200 hover:bg-[#8e1c1c] hover:border-[#8e1c1c]">
                                            Eliminar
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
