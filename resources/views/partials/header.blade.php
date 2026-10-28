<header class="sticky top-0 z-50 backdrop-blur-md bg-white/85 dark:bg-slate-900/85 border-b border-slate-200/80 dark:border-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20 gap-4">

            <!-- Logo y Marca -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-800 dark:from-white dark:to-slate-300 bg-clip-text text-transparent font-heading">
                            Portal<span class="text-indigo-600 dark:text-indigo-400">Sesiones</span>
                        </span>
                        <span class="block text-[10px] font-semibold text-slate-500 dark:text-slate-400 tracking-wider uppercase -mt-0.5">
                            Laravel Session Auth
                        </span>
                    </div>
                </a>
            </div>

            <!-- Navegación central -->
            <nav class="hidden md:flex items-center gap-1 font-medium text-sm text-slate-600 dark:text-slate-300">
                <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg hover:text-indigo-600 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ request()->routeIs('home') ? 'text-indigo-600 dark:text-indigo-400 font-semibold bg-indigo-50/70 dark:bg-indigo-950/40' : '' }}">
                    Inicio
                </a>
            </nav>

            <!-- Área de Autenticación en el Header -->
            <div class="flex items-center gap-3">
                @if(session('token'))
                    {{-- ESTADO: Con token en la sesión --}}
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-full bg-indigo-50/80 dark:bg-indigo-950/50 border border-indigo-100 dark:border-indigo-900/60 shadow-sm">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white text-xs font-bold uppercase shadow-sm">
                                {{ strtoupper(substr(session('name', 'U'), 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                                Hola, {{ session('name') }}
                            </span>
                        </div>

                        <!-- Botón para cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 border border-red-200 dark:border-red-900/50 hover:border-transparent transition-all shadow-sm duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-500/40"
                                title="Cerrar sesión"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Cerrar sesión</span>
                            </button>
                        </form>
                    </div>
                @else
                    {{-- ESTADO: Sin token en la sesión --}}
                    <div class="flex items-center gap-2 sm:gap-3">
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-indigo-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Iniciar sesión</span>
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 shadow-md shadow-indigo-600/20 hover:shadow-indigo-600/30 transition-all hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Crear cuenta</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</header>
