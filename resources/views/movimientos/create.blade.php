@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Añadir Movimiento</h1>

    <form action="{{ route('movimientos.store') }}" method="POST" class="bg-white shadow-md rounded p-6 lg:p-8 mb-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_lia">
                Elemento (Nro LIA)
            </label>
            @if(isset($nro_lia))
                <input class="w-full rounded-lg border border-gray-200 px-3 py-2 bg-gray-100" id="nro_lia_display" type="text" value="{{ $nro_lia }} - {{ $elementos->firstWhere('nro_lia', $nro_lia)->descripcion ?? '' }}" readonly>
                <input type="hidden" name="nro_lia" value="{{ $nro_lia }}">
            @else
                <select name="nro_lia" id="nro_lia" class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" required>
                    <option value="">Seleccione un elemento</option>
                    @foreach($elementos as $elemento)
                        <option value="{{ $elemento->nro_lia }}" {{ old('nro_lia') == $elemento->nro_lia ? 'selected' : '' }}>
                            {{ $elemento->nro_lia }} - {{ $elemento->descripcion }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_display">
                Usuario
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 bg-gray-100" id="user_display" type="text" value="{{ auth()->user()->nombre }}" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
                Estado
            </label>
            <select class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="estado" name="estado" required>
                @foreach(['ingresado', 'guardado', 'funcionando', 'dado de baja', 'prestado'] as $estado)
                    <option value="{{ $estado }}">{{ ucfirst($estado) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ubicacion">
                Ubicación
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="ubicacion" type="text" name="ubicacion">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha">
                Fecha
            </label>
            @can('manage-movements')
                <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="fecha" type="datetime-local" name="fecha" value="{{ now()->format('Y-m-d\TH:i') }}" required>
            @else
                <input class="w-full rounded-lg border border-gray-200 px-3 py-2 bg-gray-100" id="fecha_display" type="datetime-local" value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                <input type="hidden" name="fecha" value="{{ now()->format('Y-m-d\TH:i') }}">
            @endcan
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="comentario">
                Comentario
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="comentario" type="text" name="comentario">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-[#dba800] hover:bg-[#fbc101] text-[#111] font-semibold py-2 px-4 rounded shadow" type="submit">
                Guardar
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('movimientos.index') }}">
                Cancelar
            </a>
        </div>
    </form>
@endsection
