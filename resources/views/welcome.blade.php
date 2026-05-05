@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<div class="flex items-center justify-center min-h-[80vh] px-4 sm:px-6 lg:px-8 transition-colors duration-300">
    <div class="w-full max-w-4xl p-10 sm:p-16 text-center bg-white dark:bg-gray-800 rounded-3xl shadow-2xl transition-colors duration-300 border border-gray-100 dark:border-gray-700 relative overflow-hidden">
        
        <!-- Decoracion de fondo -->
        <div class="absolute top-0 right-0 -tr w-64 h-64 bg-blue-500 opacity-5 dark:opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500 opacity-5 dark:opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="mx-auto w-24 h-24 mb-8 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center shadow-inner">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white mb-6 tracking-tight">¡Bienvenido a MyAgenda!</h1>
            <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto">
                Has iniciado sesión con éxito. Estás listo para organizar tu día y llevar un registro de todas tus tareas importantes.
            </p>
            
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="px-8 py-4 bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 text-white text-md sm:text-lg font-bold rounded-2xl shadow-lg shadow-red-500/30 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 transform hover:-translate-y-1">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection