@extends('layouts.app')

@section('title', 'Iniciar Sesión — Práctica Sesiones')

@section('content')
<div class="flex-grow flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">

        <!-- Tarjeta de Login -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-slate-950/60 border border-slate-200/80 dark:border-slate-800 p-8 sm:p-10 transition-all">
            
            <!-- Encabezado de la tarjeta -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 mb-4 shadow-sm border border-indigo-100 dark:border-indigo-900/50">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 004 11a7.95 7.95 0 002.343 5.657"/>
                    </svg>
                </div>
                <h1 class="font-heading text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                    Iniciar Sesión
                </h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                    Accede a tu cuenta para generar un token de sesión permanente
                </p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Campo Correo Electrónico -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                        Correo electrónico
                    </label>
                    <div class="relative rounded-2xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="usuario@ejemplo.com"
                            class="block w-full pl-11 pr-4 py-3 rounded-2xl border text-sm bg-slate-50/50 dark:bg-slate-800/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all {{ $errors->has('email') ? 'border-red-400 dark:border-red-500 ring-1 ring-red-500' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                        Contraseña
                    </label>
                    <div class="relative rounded-2xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="••••••••"
                            class="block w-full pl-11 pr-4 py-3 rounded-2xl border text-sm bg-slate-50/50 dark:bg-slate-800/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all {{ $errors->has('password') ? 'border-red-400 dark:border-red-500 ring-1 ring-red-500' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Botón Submit -->
                <button
                    type="submit"
                    class="w-full mt-2 py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 shadow-lg shadow-indigo-600/25 hover:shadow-indigo-600/35 transition-all hover:scale-[1.01] active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer flex items-center justify-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span>Iniciar sesión</span>
                </button>
            </form>

            <!-- Enlace a Crear cuenta -->
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    ¿Aún no tienes una cuenta?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 hover:underline transition-colors ml-1">
                        Crear cuenta
                    </a>
                </p>
            </div>

            <!-- Caja informativa de ayuda -->
            <div class="mt-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/70 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-400">
                <div class="flex items-center gap-2 font-semibold text-slate-700 dark:text-slate-300 mb-1">
                    <svg class="w-4 h-4 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Cuenta de prueba rápida</span>
                </div>
                <p>Email: <code class="px-1.5 py-0.5 rounded bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-indigo-600 dark:text-indigo-400 font-mono">test@example.com</code></p>
                <p class="mt-1">Contraseña: <code class="px-1.5 py-0.5 rounded bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-indigo-600 dark:text-indigo-400 font-mono">password</code></p>
            </div>

        </div>

    </div>
</div>
@endsection
