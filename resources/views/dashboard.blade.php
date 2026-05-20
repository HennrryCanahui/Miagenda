@extends('layouts.sidebar')

@section('title', 'Inicio')
@section('header', 'Bienvenido a tu Agenda')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Stat Card 1 -->
    <div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-2xl shadow-xl shadow-indigo-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 p-6 flex items-center transition-transform hover:-translate-y-1">
        <div class="p-3 rounded-xl bg-indigo-50 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Contactos</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_contactos']) }}</p>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-2xl shadow-xl shadow-blue-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 p-6 flex items-center transition-transform hover:-translate-y-1">
        <div class="p-3 rounded-xl bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Categorías</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_categorias']) }}</p>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-2xl shadow-xl shadow-green-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 p-6 flex items-center transition-transform hover:-translate-y-1">
        <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nuevos (Mes)</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">+{{ number_format($stats['nuevos_mes']) }}</p>
        </div>
    </div>

    <!-- Stat Card 4 (Solo Admin) -->
    @if(auth()->user()->isAdmin())
    <div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-2xl shadow-xl shadow-purple-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 p-6 flex items-center transition-transform hover:-translate-y-1">
        <div class="p-3 rounded-xl bg-purple-50 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Usuarios</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_usuarios']) }}</p>
        </div>
    </div>
    @endif
</div>

<div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-3xl shadow-xl shadow-indigo-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 overflow-hidden">
    <div class="p-8 border-b border-gray-100 dark:border-slate-700">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Acciones Rápidas</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">¿Qué deseas hacer hoy?</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 divide-y md:divide-y-0 md:divide-x divide-gray-100 dark:divide-slate-700">
        <a href="{{ route('contacts.create') ?? '#' }}" class="p-8 group hover:bg-white/90 dark:hover:bg-slate-700/50 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Agregar Contacto</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Añade un nuevo contacto a tu directorio personal o de trabajo.</p>
        </a>

        <a href="{{ route('contacts.index') ?? '#' }}" class="p-8 group hover:bg-white/90 dark:hover:bg-slate-700/50 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-slate-800/50 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Buscar Contacto</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Encuentra rápidamente a alguien por su nombre o teléfono.</p>
        </a>

        <a href="{{ route('categorias.index') ?? '#' }}" class="p-8 group hover:bg-white/90 dark:hover:bg-slate-700/50 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Crear Categoría</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Organiza tus contactos creando grupos con colores e iconos.</p>
        </a>

        @if(auth()->user()->isAdmin())
        <a href="{{ route('users.index') ?? '#' }}" class="p-8 group hover:bg-white/90 dark:hover:bg-slate-700/50 transition-colors">
            <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Gestionar Usuarios</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Administra quién tiene acceso al sistema y sus roles.</p>
        </a>
        @endif
    </div>
</div>
@endsection
