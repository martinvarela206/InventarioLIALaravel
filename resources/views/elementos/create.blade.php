@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Añadir Elemento</h1>

    <form action="{{ route('elementos.store') }}" method="POST" class="bg-white shadow-md rounded p-6 lg:p-8 mb-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_lia">
                Nro LIA
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="nro_lia" type="text" name="nro_lia" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nro_unsj">
                Nro UNSJ
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nro_unsj" type="text" name="nro_unsj">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                Tipo
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tipo" name="tipo" required>
                <option value="cpu">CPU</option>
                <option value="monitor">Monitor</option>
                <option value="switch">Switch</option>
                <option value="router">Router</option>
                <option value="impresora">Impresora</option>
                <option value="teclado">Teclado</option>
                <option value="mouse">Mouse</option>
                <option value="proyector">Proyector</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">
                Descripción
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descripcion" type="text" name="descripcion">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="cantidad">
                Cantidad
            </label>
            <input class="w-full rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#dba800]" id="cantidad" type="number" name="cantidad" min="1" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-[#dba800] hover:bg-[#fbc101] text-[#111] font-semibold py-2 px-4 rounded shadow" type="submit">
                Guardar
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('elementos.index') }}">
                Cancelar
            </a>
        </div>
    </form>
@endsection
