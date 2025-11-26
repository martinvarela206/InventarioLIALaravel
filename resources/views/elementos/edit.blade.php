@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Elemento</h1>

    <form action="{{ route('elementos.update', $elemento->nro_lia) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_lia">
                Nro LIA
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200" id="nro_lia" type="text" name="nro_lia" value="{{ $elemento->nro_lia }}" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_unsj">
                Nro UNSJ
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nro_unsj" type="text" name="nro_unsj" value="{{ $elemento->nro_unsj }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                Tipo
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tipo" name="tipo" required>
                @foreach(['cpu', 'monitor', 'switch', 'router', 'impresora', 'teclado', 'mouse', 'proyector', 'otro'] as $tipo)
                    <option value="{{ $tipo }}" {{ $elemento->tipo == $tipo ? 'selected' : '' }}>{{ ucfirst($tipo) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">
                Descripción
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descripcion" type="text" name="descripcion" value="{{ $elemento->descripcion }}">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="cantidad">
                Cantidad
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cantidad" type="number" name="cantidad" min="1" value="{{ $elemento->cantidad }}" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Actualizar
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('elementos.index') }}">
                Cancelar
            </a>
        </div>
    </form>
@endsection
