<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Práctica de sesiones en Laravel con autenticación por token en sesión permanente.">
    <title>@yield('title', 'Práctica de Sesiones — Laravel')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', 'sans-serif'],
                        heading: ['"Outfit"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .font-heading {
            font-family: 'Outfit', system-ui, -apple-system, sans-serif;
        }
        .bg-mesh {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.06) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
        }
        @media (prefers-color-scheme: dark) {
            .bg-mesh {
                background-color: #090d16;
                background-image:
                    radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.12) 0px, transparent 50%),
                    radial-gradient(at 50% 100%, rgba(30, 27, 75, 0.25) 0px, transparent 50%);
            }
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-mesh text-slate-800 dark:text-slate-100">

    <!-- Header condicional con sesión -->
    @include('partials.header')

    <!-- Alertas Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 p-4 text-sm text-emerald-800 dark:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800/60 rounded-2xl shadow-sm animate-fade-in" role="alert">
                <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/60 flex items-center justify-center shrink-0 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="flex-1 font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 flex items-center gap-3 p-4 text-sm text-rose-800 dark:text-rose-200 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800/60 rounded-2xl shadow-sm" role="alert">
                <div class="w-8 h-8 rounded-full bg-rose-100 dark:bg-rose-900/60 flex items-center justify-center shrink-0 text-rose-600 dark:text-rose-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="flex-1 font-medium">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    <main class="flex-grow flex flex-col">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-800/80 bg-white/50 dark:bg-slate-900/50 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-500 dark:text-slate-400">
            <p>Práctica de Sesiones &bull; Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            <p class="mt-1 text-slate-400 dark:text-slate-500">Manejo de tokens permanentes en sesión con <code class="text-indigo-600 dark:text-indigo-400">session(['token' => $token, 'name' => $name])</code></p>
        </div>
    </footer>

</body>
</html>
