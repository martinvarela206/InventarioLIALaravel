<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario LIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('elementos.index') }}" class="text-xl font-bold">Inventario LIA</a>
            <div class="flex items-center">
                <a href="{{ route('revision.index') }}" class="mr-4 hover:underline text-yellow-200">Revisión</a>
                @auth
                    <a href="{{ route('elementos.index') }}" class="mr-4 hover:underline">Elementos</a>
                    <a href="{{ route('movimientos.index') }}" class="mr-4 hover:underline">Movimientos</a>
                    <span class="mr-4 text-sm bg-blue-700 px-2 py-1 rounded">{{ Auth::user()->nombre }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline text-sm">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Ingresar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
