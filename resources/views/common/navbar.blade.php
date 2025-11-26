<header style="background:#fbc101;" class="w-full shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
    <div class="mx-auto max-w-[1196px] w-full flex justify-between items-center px-6 lg:px-16 py-3">
        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:text-[#111]">
            @include('common.logo', ['variant' => 'dark', 'class' => 'w-10 h-10'])
            <span class="text-2xl font-bold text-[#111]">Sistema LIA</span>
        </a>

        @if(Request::is('/'))
            {{-- Welcome Navbar --}}
            <nav class="flex items-center gap-8">
                <a href="#inicio" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Inicio</a>
                <a href="#sistema-lia" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Sistema LIA</a>
                <a href="#lia1" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">LIA</a>
                <a href="#lia2" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Personal</a>
            </nav>
        @else
            {{-- App Navbar --}}
            <nav class="flex items-center gap-8">
                @auth
                    @if(Auth::user()->hasRole('revisor'))
                        <a href="{{ route('revision.index') }}" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Revisión</a>
                    @endif
                    @if(Auth::user()->hasRole('tecnico'))
                        <a href="{{ route('elementos.index') }}" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Elementos</a>
                    @endif
                    @if(Auth::user()->hasRole('coordinador'))
                        <a href="{{ route('movimientos.index') }}" class="text-[#111] font-medium border-b-2 border-transparent hover:border-[#111] transition-colors">Movimientos</a>
                    @endif
                @endauth
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-[#111] font-semibold tracking-wide">Bienvenido, {{ Auth::user()->nombre }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-10 h-10 bg-[#c62828] rounded-full hover:bg-[#8e1c1c] transition-colors" title="Cerrar sesión">
                            <img src="/assets/logout.svg" alt="Cerrar sesión" class="w-[22px] h-[22px] invert brightness-0" />
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#111] font-medium hover:underline">Iniciar sesión</a>
                @endauth
            </div>
        @endif
    </div>
</header>
