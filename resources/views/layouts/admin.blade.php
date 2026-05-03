<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyAgenda') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [data-mode="dark"] { color-scheme: dark; }
        [data-mode="light"] { color-scheme: light; }
        /* Ocultar barra de desplazamiento pero permitir scroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-gray-900 dark:text-gray-100 transition-colors duration-300 overflow-hidden h-screen flex">
    
    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 bg-white dark:bg-slate-900 border-r border-gray-200 dark:border-slate-800 flex flex-col transition-all duration-300 z-20">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-slate-800 bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-900 dark:to-blue-900">
            <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span class="text-xl font-bold text-white tracking-wider">MyAgenda</span>
        </div>

        <!-- Navegación -->
        <nav class="flex-1 overflow-y-auto no-scrollbar py-4 px-3 space-y-1">
            <a href="{{ route('dashboard') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 group transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Inicio
            </a>

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contactos</p>
            </div>
            
            <a href="{{ route('contacts.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 group transition-colors">
                <svg class="w-5 h-5 mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Directorio
            </a>

            <a href="{{ route('categories.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 group transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Gestión de Categorías
            </a>

            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Administración</p>
            </div>

            <a href="{{ route('users.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 group transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios y Roles
            </a>
            @endif

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sistema</p>
            </div>

            <a href="{{ route('help.about') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 group transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Ayuda / Acerca de
            </a>
        </nav>

        <!-- User bottom -->
        <div class="p-4 border-t border-gray-200 dark:border-slate-800">
            <div class="flex items-center w-full px-2 py-2 text-sm rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                <img class="h-8 w-8 rounded-full object-cover border-2 border-indigo-500" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nombres ?? 'User') }}&background=6366f1&color=fff" alt="Avatar">
                <div class="ml-3 flex-1 overflow-hidden">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ auth()->user()->nombres ?? 'Usuario' }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->rol->nombre ?? 'Estándar' }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main wrapper -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-950 relative">
        <!-- Decoraciones de fondo similares al login -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40 pointer-events-none"></div>
        
        <!-- Header -->
        <header class="h-16 flex-shrink-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-gray-200 dark:border-slate-800 flex items-center justify-between px-6 z-10 sticky top-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@yield('header', 'Dashboard')</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-900"></span>
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6 z-10">
            <div class="max-w-7xl mx-auto space-y-6">
                @yield('content')
            </div>
        </main>
    </div>
    
    @yield('scripts')
</body>
</html>
