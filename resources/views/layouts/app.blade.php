<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    
    <script>
        // Tema inicial antes de que cargue Alpine para evitar destellos
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || ((!savedTheme || savedTheme === 'system') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dark {
            color-scheme: dark;
        }
        :root:not(.dark) {
            color-scheme: light;
        }
        /* Ocultar barra de desplazamiento pero permitir scroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @yield('styles')
    </style>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 transition-colors duration-300 @yield('body_class', 'bg-gray-50 dark:bg-slate-950')">
    
    @yield('layout')

    @yield('scripts')
</body>
</html>