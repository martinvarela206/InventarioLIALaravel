@extends('layouts.app')

@section('content')
    <h2 class="text-center mt-10 text-[#dba800] text-2xl font-semibold">Lista de Movimientos</h2>

    @can('write-data')
        <a href="{{ route('movimientos.create') }}" class="inline-block mt-5 ml-[5%] bg-[#dba800] text-[#111] px-5 py-2 rounded font-semibold transition-colors duration-200 hover:bg-[#fbc101] no-underline border-2 border-[#dba800] hover:border-[#fbc101]">Añadir Movimiento</a>
    @endcan

    <div class="w-[90%] mx-auto mt-8 shadow-md bg-white rounded-lg overflow-hidden">
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
                            @if($loop->first)
                                <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Último</span>
                            @endif
                        </td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->estado }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->ubicacion }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->fecha->format('Y-m-d H:i') }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->comentario }}</td>
                        <td class="py-2.5 px-3.5 text-[#111]">{{ $m->usuario->nombre ?? 'N/A' }}</td>
                        <td class="py-2.5 px-3.5" onclick="event.stopPropagation()">
                            <div class="flex items-center gap-1">
                                @can('write-data')
                                    <a href="{{ route('movimientos.edit', $m->id) }}" class="bg-[#dba800] text-[#111] border-2 border-[#dba800] rounded px-3.5 py-1.5 cursor-pointer text-sm font-medium transition-colors duration-200 hover:bg-[#fbc101] hover:border-[#fbc101]">
                                        Modificar
                                    </a>
                                @endcan
                                @can('delete-data')
                                    <form action="{{ route('movimientos.destroy', $m->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este movimiento?');" class="inline">
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
