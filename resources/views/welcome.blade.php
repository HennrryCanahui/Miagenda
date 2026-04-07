@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="p-8 text-center bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-8 transition-colors duration-300 border border-transparent dark:border-gray-700">
        <h1 class="text-4xl font-extrabold text-blue-600 dark:text-blue-400 mb-4 tracking-tight">¡Bienvenido a MyAgenda!</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">Has iniciado sesión con éxito.</p>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-6 py-3 bg-red-600 dark:bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75 transition-all">
                Cerrar Sesión
            </button>
        </form>
    </div>
@endsection