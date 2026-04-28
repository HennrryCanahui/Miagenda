@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl max-h-[90vh] overflow-y-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-slate-700/50 backdrop-blur-sm">
            
            <!-- Left Panel -->
            <div class="hidden lg:flex lg:flex-col lg:justify-center relative overflow-hidden bg-gradient-to-br from-indigo-900/90 via-blue-900/80 to-slate-900 backdrop-blur-xl border-r border-white/10 p-12 min-h-[500px]">
                <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40"></div>
                
                <div class="relative z-10 space-y-8 text-center">
                    <div class="space-y-3">
                        <h2 class="text-4xl font-extrabold text-white tracking-tight">Recuperación</h2>
                        <p class="text-blue-100/80 text-base leading-relaxed max-w-xs mx-auto">
                            No te preocupes, te ayudaremos a recuperar el acceso a tu cuenta de forma segura.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-14 min-h-[500px]">
                <div class="space-y-2 mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">¿Olvidaste tu contraseña?</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Ingresa tu correo electrónico para verificar tu identidad</p>
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

                <form action="{{ route('password.email') }}" method="POST" class="space-y-5 flex-1">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                autofocus
                                placeholder="correo@ejemplo.com"
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full mt-6 py-3.5 px-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/40"
                    >
                        Continuar
                    </button>

                    <div class="pt-6 border-t border-gray-200 dark:border-slate-700 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            ¿Recordaste tu contraseña? 
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors ml-1">
                                Volver al inicio
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
