@extends('layouts.app')

@section('title', 'Inicio — Práctica de Sesiones')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">

    <!-- Hero Header -->
    <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-100/80 dark:bg-indigo-950/70 border border-indigo-200 dark:border-indigo-800 text-xs font-semibold text-indigo-700 dark:text-indigo-300 mb-6 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
            <span>Ejercicio de Clase: Sesiones en Laravel</span>
        </div>
        <h1 class="font-heading text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-tight">
            Autenticación por <span class="bg-gradient-to-r from-indigo-600 to-violet-500 bg-clip-text text-transparent">Token en Sesión</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-300">
            Demostración completa de login, logout y visualización condicional en el header utilizando los datos permanentes de la sesión.
        </p>
    </div>

    <!-- Panel de Estado de la Sesión -->
    <div class="max-w-4xl mx-auto">
        @if(session('token'))
            {{-- TARJETA: SESIÓN ACTIVA --}}
            <div class="bg-white dark:bg-slate-900 rounded-3xl border-2 border-indigo-500/30 dark:border-indigo-500/40 shadow-2xl shadow-indigo-500/10 p-8 sm:p-10 mb-10 overflow-hidden relative">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-6 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white text-2xl font-bold uppercase shadow-lg shadow-indigo-600/30">
                            {{ strtoupper(substr(session('name', 'U'), 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300">
                                    ● Sesión Activa
                                </span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">
                                ¡Hola, {{ session('name') }}!
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                                Tus datos están guardados en la sesión de Laravel
                            </p>
                        </div>
                    </div>

                    <!-- Botón de Logout directo -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-red-600 hover:bg-red-700 shadow-md shadow-red-600/20 transition-all hover:scale-[1.02] active:scale-[0.98] cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>

                <!-- Detalle de variables de sesión -->
                <div class="mt-6 space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Datos almacenados en la sesión:
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 block mb-1">
                                Clave: <code class="text-indigo-600 dark:text-indigo-400 font-mono">session('name')</code>
                            </span>
                            <span class="text-base font-semibold text-slate-800 dark:text-slate-100">
                                {{ session('name') }}
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 block mb-1">
                                Clave: <code class="text-indigo-600 dark:text-indigo-400 font-mono">session('token')</code>
                            </span>
                            <p class="text-xs font-mono text-indigo-700 dark:text-indigo-300 break-all select-all bg-white dark:bg-slate-900 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                                {{ session('token') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- TARJETA: SIN SESIÓN --}}
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-xl p-8 sm:p-10 mb-10 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 mx-auto mb-5 border border-slate-200 dark:border-slate-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 mb-3">
                    ○ Sin Token en Sesión
                </span>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                    No has iniciado sesión
                </h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400 max-w-lg mx-auto">
                    Como no existe ningún token en la sesión permanente, el header muestra los botones para <strong class="text-slate-700 dark:text-slate-200">Iniciar sesión</strong> y <strong class="text-slate-700 dark:text-slate-200">Crear cuenta</strong>.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a
                        href="{{ route('login') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-600/20 transition-all hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Ir al formulario de Login</span>
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Crear cuenta nueva</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Requisitos Implementados -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tarjeta 1 -->
            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm mb-4">
                    1
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-1.5">Función de Login</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Valida credenciales con <code class="text-indigo-600 dark:text-indigo-400 font-mono">Hash::check</code>, genera un token con <code class="text-indigo-600 dark:text-indigo-400 font-mono">Str::random(60)</code> y lo guarda permanentemente con <code class="text-indigo-600 dark:text-indigo-400 font-mono">session(['token' => $token, 'name' => $user->name])</code>.
                </p>
            </div>

            <!-- Tarjeta 2 -->
            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-sm mb-4">
                    2
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-1.5">Cerrar Sesión (Logout)</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Ejecuta <code class="text-indigo-600 dark:text-indigo-400 font-mono">$request->session()->invalidate()</code> y <code class="text-indigo-600 dark:text-indigo-400 font-mono">$request->session()->regenerateToken()</code>, redirigiendo a la página de login.
                </p>
            </div>

            <!-- Tarjeta 3 -->
            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm mb-4">
                    3
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-1.5">Header Condicional</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Si no hay token: botones <em>Iniciar sesión</em> y <em>Crear cuenta</em>.<br>
                    Si hay token: muestra <em>"Hola, {nombre}"</em> y la acción de desconexión.
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
