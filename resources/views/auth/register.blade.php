@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
    <div class="max-w-2xl w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700">
        <div>
            <h2 class="mt-2 text-center text-4xl font-extrabold text-blue-600 dark:text-blue-400 pb-4 tracking-tight">
                Crear una cuenta
            </h2>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                Únete y comienza a organizar tu tiempo eficientemente.
            </p>
        </div>
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-4 rounded-r-md" role="alert">
                <p class="text-sm font-semibold text-red-800 dark:text-red-400">Por favor corrige los siguientes errores:</p>
                <ul class="mt-2 list-disc list-inside text-xs text-red-700 dark:text-red-300 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombres -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombres</label>
                    <input id="nombres" name="nombres" type="text" value="{{ old('nombres') }}" required autofocus 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900">
                </div>

                <!-- Apellidos -->
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" value="{{ old('apellidos') }}" required 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900">
                </div>

                <!-- Correo Electrónico -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900" 
                        placeholder="correo@ejemplo.com">
                </div>

                <!-- Contraseña -->
                <div class="md:col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contraseña (Mínimo 8 caracteres)</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="md:col-span-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmar Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900">
                </div>

                <!-- Pregunta Secreta -->
                <div class="md:col-span-2 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl leading-6 font-semibold text-gray-900 dark:text-white mb-6">Seguridad Adicional</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pregunta_secreta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pregunta Secreta</label>
                            <select id="pregunta_secreta" name="pregunta_secreta" required 
                                class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all bg-white text-gray-900">
                                <option value="" disabled {{ old('pregunta_secreta') ? '' : 'selected' }}>Seleccione una pregunta...</option>
                                <option value="nombre_mascota" {{ old('pregunta_secreta') == 'nombre_mascota' ? 'selected' : '' }}>¿Cual es el nombre de su primera mascota?</option>
                                <option value="ciudad_nacimiento" {{ old('pregunta_secreta') == 'ciudad_nacimiento' ? 'selected' : '' }}>¿En qué ciudad nació?</option>
                                <option value="color_favorito" {{ old('pregunta_secreta') == 'color_favorito' ? 'selected' : '' }}>¿Cuál es su color favorito?</option>
                                <option value="nombre_abuela" {{ old('pregunta_secreta') == 'nombre_abuela' ? 'selected' : '' }}>¿Cuál es el nombre de su abuela materna?</option>
                            </select>
                        </div>
        
                        <!-- Respuesta Secreta -->
                        <div>
                            <label for="respuesta_secreta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Respuesta Secreta</label>
                            <input id="respuesta_secreta" name="respuesta_secreta" type="password" required autocomplete="off" 
                                class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all text-gray-900">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col-reverse md:flex-row items-center justify-between gap-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors">
                    ¿Ya tienes una cuenta? Iniciar Sesión
                </a>
                
                <button type="submit" 
                    class="w-full md:w-auto flex justify-center py-3 px-8 border border-transparent text-sm font-semibold rounded-xl shadow-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 transform hover:-translate-y-0.5">
                    Registrarme
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
