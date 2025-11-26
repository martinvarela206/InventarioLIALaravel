@extends('layouts.app')

@section('content')
    <h2 class="text-center mt-10 text-[#dba800] text-2xl font-semibold">Lista de Movimientos</h2>

    @can('write-data')
        <a href="{{ route('movimientos.create') }}" class="inline-block mt-5 ml-[5%] bg-[#dba800] text-[#111] px-5 py-2 rounded font-semibold transition-colors duration-200 hover:bg-[#fbc101] no-underline border-2 border-[#dba800] hover:border-[#fbc101]">Añadir Movimiento</a>
    @endcan

    <div class="flex justify-end gap-4 w-[90%] mx-auto mt-4">
        <a href="{{ route('movimientos.index', array_merge(request()->all(), ['ultimo' => !request()->boolean('ultimo')])) }}" 
           class="px-4 py-1 rounded-full border border-amber-700 text-sm font-semibold transition-colors {{ request()->boolean('ultimo') ? 'bg-amber-700 text-white' : 'text-amber-700 hover:bg-amber-50' }}">
           Último
        </a>
        <a href="{{ route('movimientos.index', array_merge(request()->all(), ['prestado' => !request()->boolean('prestado')])) }}" 
           class="px-4 py-1 rounded-full border border-amber-700 text-sm font-semibold transition-colors {{ request()->boolean('prestado') ? 'bg-amber-700 text-white' : 'text-amber-700 hover:bg-amber-50' }}">
           Prestado
        </a>
    </div>

    <div class="w-[90%] mx-auto mt-4 shadow-md bg-white rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#fbc101] text-[#111]">
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Nro LIA</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Estado</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Ubicación</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Fecha</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Comentario</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Usuario</th>
                    <th class="py-2.5 px-3.5 text-left font-semibold tracking-wide">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimientos as $m)
                    <tr class="hover:bg-[#fcd34d] transition-colors border-b border-gray-200 last:border-b-0 cursor-pointer" onclick="window.location='{{ route('elementos.show', $m->elemento->nro_lia) }}'">
                        <td class="py-2.5 px-3.5 text-[#111]">
                            {{ $m->elemento->nro_lia ?? 'N/A' }}
                            @if($m->elemento && $m->elemento->ultimoMovimiento && $m->elemento->ultimoMovimiento->id === $m->id)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-amber-700 text-white">Último</span>
                            @endif
                        </td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->estado }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->ubicacion }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->fecha->format('Y-m-d H:i') }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->comentario }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->usuario->nombre ?? 'N/A' }}</td>
                        <td class="py-2.5 px-3.5" onclick="event.stopPropagation()">
                            <div class="flex items-center justify-center gap-1">
                                @can('write-data')
                                    <a href="{{ route('movimientos.edit', $m->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Modificar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                @endcan
                                @can('delete-data')
                                    <form action="{{ route('movimientos.destroy', $m->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este movimiento?');" class="inline">
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
@endsection
