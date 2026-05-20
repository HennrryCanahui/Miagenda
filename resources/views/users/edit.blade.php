@extends('layouts.sidebar')

@section('title', 'Editar Usuario')
@section('header', 'Editar Usuario: ' . $user->nombres)

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Modifica los datos del usuario en el sistema. Deja la contraseña en blanco si no deseas cambiarla.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 dark:border-slate-600 text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 shadow-sm transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Hay {{ $errors->count() }} errores con tu envío</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="bg-white/80 backdrop-blur-md dark:bg-slate-800 rounded-3xl shadow-xl shadow-indigo-500/10 dark:shadow-none border border-white/50 dark:border-slate-700 overflow-hidden">
    <div class="p-6 sm:p-8">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nombres -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombres <span class="text-red-500">*</span></label>
                    <input type="text" name="nombres" id="nombres" value="{{ old('nombres', $user->nombres) }}" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                </div>
                
                <!-- Apellidos -->
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellidos <span class="text-red-500">*</span></label>
                    <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                </div>
                
                <!-- Rol -->
                <div>
                    <label for="rol_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rol <span class="text-red-500">*</span></label>
                    <select name="rol_id" id="rol_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                        <option value="">Selecciona un rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_id', $user->rol_id) == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contraseña (opcional)</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none" placeholder="Dejar en blanco para mantener la actual">
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                </div>
                
                <!-- Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado <span class="text-red-500">*</span></label>
                    <select name="estado" id="estado" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                        <option value="1" {{ old('estado', $user->estado) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado', $user->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-slate-700 pt-6 mt-6">
                <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">Seguridad (Opcional)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pregunta Secreta -->
                    <div>
                        <label for="pregunta_secreta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pregunta Secreta</label>
                        <input type="text" name="pregunta_secreta" id="pregunta_secreta" value="{{ old('pregunta_secreta', $user->pregunta_secreta) }}" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                    </div>
                    
                    <!-- Respuesta Secreta -->
                    <div>
                        <label for="respuesta_secreta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Respuesta Secreta</label>
                        <input type="text" name="respuesta_secreta" id="respuesta_secreta" value="{{ old('respuesta_secreta', $user->respuesta_secreta) }}" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
