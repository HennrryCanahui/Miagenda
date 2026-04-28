<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [data-mode="dark"] {
            color-scheme: dark;
        }
        [data-mode="light"] {
            color-scheme: light;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white dark:bg-slate-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-screen bg-gradient-to-b from-white via-blue-50/30 dark:from-slate-950 dark:via-slate-900/30 to-white dark:to-slate-950">
        @isset($header)
            <header class="bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-700 dark:to-blue-700 shadow-lg border-b border-indigo-500/20">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-bold text-3xl tracking-tight leading-tight text-white drop-shadow-sm">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>