@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Movimiento</h1>

    <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_lia">
                Elemento (Nro LIA)
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nro_lia" name="nro_lia" required>
                @foreach($elementos as $elemento)
                    <option value="{{ $elemento->nro_lia }}" {{ $movimiento->nro_lia == $elemento->nro_lia ? 'selected' : '' }}>{{ $elemento->nro_lia }} - {{ $elemento->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                Usuario
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="user_id" name="user_id" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $movimiento->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
                Estado
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="estado" name="estado" required>
                @foreach(['ingresado', 'guardado', 'funcionando', 'dado de baja', 'prestado'] as $estado)
                    <option value="{{ $estado }}" {{ $movimiento->estado == $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ubicacion">
                Ubicación
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ubicacion" type="text" name="ubicacion" value="{{ $movimiento->ubicacion }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha">
                Fecha
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha" type="datetime-local" name="fecha" value="{{ $movimiento->fecha->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="comentario">
                Comentario
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comentario" type="text" name="comentario" value="{{ $movimiento->comentario }}">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Actualizar
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('movimientos.index') }}">
                Cancelar
            </a>
        </div>
    </form>
@endsection
