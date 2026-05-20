@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl max-h-[90vh] overflow-y-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white dark:bg-blue-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-blue-800/50 backdrop-blur-sm">
            
            <!-- Left Panel -->
            <div class="hidden lg:flex lg:flex-col lg:justify-center relative overflow-hidden bg-gradient-to-br from-indigo-900/90 via-blue-900/80 to-slate-900 backdrop-blur-xl border-r border-white/10 p-12 min-h-[500px]">
                <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40"></div>
                
                <div class="relative z-10 space-y-8 text-center">
                    <div class="space-y-3">
                        <h2 class="text-4xl font-extrabold text-white tracking-tight">Seguridad</h2>
                        <p class="text-blue-100/80 text-base leading-relaxed max-w-xs mx-auto">
                            Responde correctamente para restablecer tu acceso.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-14 min-h-[500px]">
                <div class="space-y-2 mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Pregunta de Seguridad</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Para: <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $email }}</span></p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/30 border-l-4 border-red-500 rounded-r-xl" role="alert">
                        <ul class="text-xs text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update.question') }}" method="POST" class="space-y-5 flex-1">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Secret Question Display -->
                    <div class="p-4 bg-indigo-50 dark:bg-blue-800/50 rounded-2xl border border-indigo-100 dark:border-blue-700">
                        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-1">Tu pregunta:</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">"{{ $pregunta }}"</p>
                    </div>

                    <!-- Answer Input -->
                    <div class="space-y-2">
                        <label for="respuesta" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Tu Respuesta
                        </label>
                        <input 
                            id="respuesta" 
                            name="respuesta" 
                            type="text" 
                            required 
                            autofocus
                            placeholder="Escribe tu respuesta aquí"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-blue-800 border border-gray-300 dark:border-blue-700 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                        >
                    </div>

                    <!-- New Password Input -->
                    <div class="space-y-2 pt-4 border-t border-gray-100 dark:border-blue-800">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Nueva Contraseña
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-blue-800 border border-gray-300 dark:border-blue-700 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                        >
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Confirmar Nueva Contraseña
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-blue-800 border border-gray-300 dark:border-blue-700 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full mt-6 py-3.5 px-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 focus:ring-emerald-500 shadow-lg shadow-emerald-500/30 hover:shadow-lg hover:shadow-emerald-500/40"
                    >
                        Restablecer Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
