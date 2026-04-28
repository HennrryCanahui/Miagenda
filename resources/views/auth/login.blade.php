@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl max-h-[90vh] overflow-y-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-slate-700/50 backdrop-blur-sm">
            
            <!-- Left Panel - Info Section (Hidden on mobile) -->
            <div class="hidden lg:flex lg:flex-col lg:justify-center relative overflow-hidden bg-gradient-to-br from-indigo-900/90 via-blue-900/80 to-slate-900 backdrop-blur-xl border-r border-white/10 p-12 min-h-[500px]">
    
            <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40"></div>
            
            <div class="relative z-10 space-y-8 text-center">
                

                <div class="space-y-3">
                    <h2 class="text-4xl font-extrabold text-white tracking-tight">
                        Bienvenido
                    </h2>
                    <p class="text-blue-100/80 text-base leading-relaxed max-w-xs mx-auto">
                        Organiza tu vida de forma sencilla y segura con MyAgenda.
                    </p>
                </div>

                
                    
            </div>
        </div>

            <!-- Right Panel - Login Form -->
            <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-14 min-h-[500px]">
                <div class="space-y-2 mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Iniciar Sesión</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Ingresa tus credenciales para continuar</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/30 border-l-4 border-red-500 rounded-r-xl" role="alert">
                        <p class="text-sm font-semibold text-red-800 dark:text-red-300">Revisa los datos e intenta de nuevo:</p>
                        <ul class="mt-3 text-xs text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5 flex-1">
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
                                autocomplete="email" 
                                required 
                                value="{{ old('email') }}"
                                placeholder="correo@ejemplo.com"
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Contraseña
                            </label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                required 
                                placeholder="••••••••"
                                class="w-full pl-12 pr-14 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none transition-colors"
                            >
                                <span id="password-toggle-icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center pt-2">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-indigo-600 dark:text-indigo-500 bg-gray-50 dark:bg-slate-700 border-gray-300 dark:border-slate-600 rounded focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-colors cursor-pointer"
                        >
                        <label for="remember" class="ml-3 block text-sm text-gray-700 dark:text-gray-400 cursor-pointer select-none">
                            Recordarme en este dispositivo
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full mt-6 py-3.5 px-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 dark:from-indigo-600 dark:to-blue-600 dark:hover:from-indigo-700 dark:hover:to-blue-700 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/40"
                    >
                        Ingresar a mi Agenda
                    </button>

                    <!-- Register Link -->
                    <div class="pt-6 border-t border-gray-200 dark:border-slate-700 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            ¿No tienes una cuenta? 
                            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors ml-1">
                                Crear cuenta nueva
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("password-toggle-icon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3.375 3.375 0 11-4.753 4.753m4.753-4.753L3.596 3.596"/></svg>';
        } else {
            passwordInput.type = "password";
            toggleIcon.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
        }
    }
</script>
@endsection