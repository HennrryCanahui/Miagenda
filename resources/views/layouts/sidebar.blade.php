@extends('layouts.app')

@section('body_class', 'bg-gray-50 dark:bg-slate-950 overflow-hidden h-screen flex')

@section('layout')
    
    <!-- Sidebar -->
    <aside class="w-64 min-w-[16rem] max-w-[16rem] flex-none bg-white shadow-[1px_0_15px_rgba(0,0,0,0.03)] dark:shadow-none dark:bg-slate-800 border-gray-100 dark:border-slate-700 flex flex-col transition-all duration-300 z-20">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6  border-gray-100 dark:border-slate-700 bg-blue-600">
            <svg class="w-8 h-8 text-white mr-3 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span class="text-xl font-bold text-white tracking-wider drop-shadow-sm">MyAgenda</span>
        </div>

        <!-- Navegación -->
        <nav class="flex-1 overflow-y-auto no-scrollbar py-4 px-3 space-y-1">
            <a href="{{ route('dashboard') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl group transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-50/80 border border-blue-100/50 shadow-sm dark:border-transparent dark:shadow-none dark:bg-indigo-500/10 text-blue-700 dark:text-indigo-400' : 'hover:bg-gray-50 border border-transparent dark:hover:bg-indigo-500/10 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-blue-500 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Inicio
            </a>

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contactos</p>
            </div>
            
            <a href="{{ route('contacts.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl group transition-colors {{ request()->routeIs('contacts.*') ? 'bg-blue-50/80 border border-blue-100/50 shadow-sm dark:border-transparent dark:shadow-none dark:bg-indigo-500/10 text-blue-700 dark:text-indigo-400' : 'hover:bg-gray-50 border border-transparent dark:hover:bg-indigo-500/10 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('contacts.*') ? 'text-blue-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-blue-500 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Directorio
            </a>

            <a href="{{ route('categorias.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl group transition-colors {{ request()->routeIs('categorias.*') ? 'bg-blue-50/80 border border-blue-100/50 shadow-sm dark:border-transparent dark:shadow-none dark:bg-indigo-500/10 text-blue-700 dark:text-indigo-400' : 'hover:bg-gray-50 border border-transparent dark:hover:bg-indigo-500/10 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('categorias.*') ? 'text-blue-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-blue-500 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Gestión de Categorías
            </a>

            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Administración</p>
            </div>

            <a href="{{ route('users.index') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl group transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-50/80 border border-blue-100/50 shadow-sm dark:border-transparent dark:shadow-none dark:bg-indigo-500/10 text-blue-700 dark:text-indigo-400' : 'hover:bg-gray-50 border border-transparent dark:hover:bg-indigo-500/10 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-blue-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-blue-500 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios y Roles
            </a>
            @endif

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sistema</p>
            </div>

            <a href="{{ route('help.about') ?? '#' }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl group transition-colors {{ request()->routeIs('help.*') ? 'bg-blue-50/80 border border-blue-100/50 shadow-sm dark:border-transparent dark:shadow-none dark:bg-indigo-500/10 text-blue-700 dark:text-indigo-400' : 'hover:bg-gray-50 border border-transparent dark:hover:bg-indigo-500/10 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('help.*') ? 'text-blue-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-blue-500 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Acerca del Sistema
            </a>
        </nav>

        <!-- User bottom with dropdown -->
        <div class="p-4 border-t border-gray-100 dark:border-slate-700 relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-sm rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors cursor-pointer text-left focus:outline-none">
                <img class="h-8 w-8 rounded-full object-cover border-2 border-blue-500 dark:border-indigo-500 flex-shrink-0" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nombres ?? 'User') }}&background=2563eb&color=fff" alt="Avatar">
                <div class="ml-3 flex-1 overflow-hidden">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ auth()->user()->nombres ?? 'Usuario' }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->rol->nombre ?? 'Estándar' }}</p>
                </div>
                <!-- Chevron indicator -->
                <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 text-gray-400 transition-transform duration-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="transform opacity-0 translate-y-4"
                 x-transition:enter-end="transform opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="transform opacity-100 translate-y-0"
                 x-transition:leave-end="transform opacity-0 translate-y-4"
                 class="absolute bottom-full left-0 w-full mb-2 px-4 z-50 origin-bottom"
                 style="display: none;">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden py-1">
                    
                   
                    
                    <!-- Editar Perfil -->
                    <a href="{{ route('users.edit', auth()->user()->id) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-slate-700 dark:hover:text-indigo-400 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Ajustes de Cuenta
                    </a>

                    <div class="h-px bg-gray-200 dark:bg-slate-700 my-1"></div>

                    <!-- Cerrar Sesión -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main wrapper -->
    <div class="flex-1 flex flex-col min-w-0 w-full overflow-hidden bg-gray-50 dark:bg-slate-950 relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/10 dark:bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 dark:bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40 pointer-events-none"></div>
        
        <!-- Header -->
        <header class="h-16 flex-shrink-0 bg-gradient-to-r from-blue-600 to-cyan-500 shadow-md border-transparent flex items-center justify-between px-6 z-20 sticky top-0 dark:from-slate-900/80 dark:to-slate-900/80 dark:bg-none dark:backdrop-blur-md dark:border-slate-800">

            <div>
                <h1 class="text-2xl font-bold text-white drop-shadow-sm">@yield('header', 'Dashboard')</h1>
            </div>
            
            <div class="flex items-center space-x-4 ml-auto">
                <!-- Notificaciones 
                <button class="text-white hover:text-white/80 transition-colors relative focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-cyan-500 dark:bg-red-500 ring-2 ring-white dark:ring-slate-900"></span>
                </button>
                 -->

                <!-- Theme Switcher -->
                <div class="relative" x-data="{ 
                        openTheme: false, 
                        theme: localStorage.getItem('theme') || 'system',
                        setTheme(val) {
                            this.theme = val;
                            if (val === 'dark') {
                                document.documentElement.classList.add('dark');
                                localStorage.setItem('theme', 'dark');
                            } else if (val === 'light') {
                                document.documentElement.classList.remove('dark');
                                localStorage.setItem('theme', 'light');
                            } else {
                                localStorage.setItem('theme', 'system');
                                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                                    document.documentElement.classList.add('dark');
                                } else {
                                    document.documentElement.classList.remove('dark');
                                }
                            }
                            this.openTheme = false;
                        }
                    }" @click.away="openTheme = false">
                    <button @click="openTheme = !openTheme" class="text-white hover:text-white/80 transition-colors relative focus:outline-none flex items-center justify-center">
                        <!-- Icono claro -->
                        <svg x-show="theme === 'light'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <!-- Icono oscuro -->
                        <svg x-show="theme === 'dark'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <!-- Icono sistema -->
                        <svg x-show="theme === 'system'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </button>

                    <!-- Dropdown de Tema -->
                    <div x-show="openTheme"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-36 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden py-1 z-50 origin-top-right"
                        style="display: none;">
                        <button @click="setTheme('light')" :class="{ 'bg-blue-50 dark:bg-slate-700/50 text-blue-600 dark:text-indigo-400': theme === 'light' }" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Claro
                        </button>
                        <button @click="setTheme('dark')" :class="{ 'bg-blue-50 dark:bg-slate-700/50 text-blue-600 dark:text-indigo-400': theme === 'dark' }" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            Oscuro
                        </button>
                        <button @click="setTheme('system')" :class="{ 'bg-blue-50 dark:bg-slate-700/50 text-blue-600 dark:text-indigo-400': theme === 'system' }" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Sistema
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 z-0">
            <div class="max-w-7xl mx-auto w-full space-y-6">
                @yield('content')
            </div>
        </main>
    </div>
    
@endsection
