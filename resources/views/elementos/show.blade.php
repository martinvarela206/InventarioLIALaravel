@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detalle del Elemento</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Nro LIA:</strong> {{ $elemento->nro_lia }}</div>
            <div><strong>Nro UNSJ:</strong> {{ $elemento->nro_unsj }}</div>
            <div><strong>Tipo:</strong> {{ $elemento->tipo }}</div>
            <div><strong>Descripción:</strong> {{ $elemento->descripcion }}</div>
            <div><strong>Cantidad:</strong> {{ $elemento->cantidad }}</div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Movimientos asociados</h2>
        @can('write-data')
            <a href="{{ route('movimientos.create', ['nro_lia' => $elemento->nro_lia]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">Añadir Movimiento</a>
        @endcan
    </div>
    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Fecha</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Ubicación</th>
                    <th class="py-3 px-6 text-left">Comentario</th>
                    @can('manage-movements')
                        <th class="py-3 px-6 text-center">Acciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($movimientos as $m)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $m->fecha->format('Y-m-d H:i') }}</td>
                        <td class="py-3 px-6 text-left">{{ $m->estado }}</td>
                        <td class="py-3 px-6 text-left">{{ $m->ubicacion }}</td>
                        <td class="py-3 px-6 text-left">{{ $m->comentario }}</td>
                        @can('manage-movements')
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('movimientos.edit', $m->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('movimientos.destroy', $m->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este movimiento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        @if(request('from') == 'revision')
            <a href="{{ route('revision.index') }}" class="text-blue-500 hover:underline">Volver a Revisión</a>
        @else
            <a href="{{ route('elementos.index') }}" class="text-blue-500 hover:underline">Volver a Elementos</a>
        @endif
    </div>
@endsection
