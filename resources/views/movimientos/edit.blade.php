@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Movimiento</h1>

    <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST" class="bg-white shadow-md rounded p-6 lg:p-8 mb-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_lia">
                Elemento (Nro LIA)
            </label>
            <select class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="nro_lia" name="nro_lia" required>
                @foreach($elementos as $elemento)
                    <option value="{{ $elemento->nro_lia }}" {{ $movimiento->nro_lia == $elemento->nro_lia ? 'selected' : '' }}>{{ $elemento->nro_lia }} - {{ $elemento->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                Usuario
            </label>
            <select class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="user_id" name="user_id" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $movimiento->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
                Estado
            </label>
            <select class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="estado" name="estado" required>
                @foreach(['ingresado', 'guardado', 'funcionando', 'dado de baja', 'prestado'] as $estado)
                    <option value="{{ $estado }}" {{ $movimiento->estado == $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ubicacion">
                Ubicación
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="ubicacion" type="text" name="ubicacion" value="{{ $movimiento->ubicacion }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha">
                Fecha
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="fecha" type="datetime-local" name="fecha" value="{{ $movimiento->fecha->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="comentario">
                Comentario
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="comentario" type="text" name="comentario" value="{{ $movimiento->comentario }}">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-[#dba800] hover:bg-[#fbc101] text-[#111] font-semibold py-2 px-4 rounded shadow" type="submit">
                Actualizar
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('movimientos.index') }}">
                Cancelar
            </a>
        </div>
    </form>
@endsection
