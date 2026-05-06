@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl max-h-[90vh] overflow-y-auto">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-slate-700/50">
            
            <!-- Left Panel - Info Section (Hidden on mobile) -->
            <div class="lg:flex lg:col-span-2 lg:flex-col lg:justify-center lg:items-center relative overflow-hidden bg-gradient-to-br from-indigo-900/95 via-blue-900/90 to-slate-900 backdrop-blur-xl border-r border-white/10 p-8 sm:p-12 lg:p-16 min-h-[600px]">
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-red-500/10 rounded-full blur-3xl -ml-40 -mb-40"></div>
                
                <div class="relative z-10 w-full max-w-sm space-y-8">
                    
                    <div class="space-y-8 text-center lg:text-left">
                        <div class="space-y-4">
                            <h2 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight drop-shadow-xl">
                                Únete a nosotros
                            </h2>
                            <p class="text-lg lg:text-xl text-blue-100/80 leading-relaxed">
                                Comienza a organizar tu tiempo eficientemente. Tu productividad mejorará desde el primer día.
                            </p>
                        </div>
<!--
                        <div class="space-y-4 pt-4">
                            <div class="flex flex-col sm:flex-row lg:flex-col items-center lg:items-start gap-4 p-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 flex items-center justify-center flex-shrink-0 border border-indigo-500/30">
                                    <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div class="text-center lg:text-left">
                                    <p class="text-white font-semibold text-sm">Seguridad Avanzada</p>
                                    <p class="text-blue-100/60 text-xs mt-1">Datos y preguntas protegidos con cifrado industrial.</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row lg:flex-col items-center lg:items-start gap-4 p-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center flex-shrink-0 border border-blue-500/30">
                                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-center lg:text-left">
                                    <p class="text-white font-semibold text-sm">Recuperación Simple</p>
                                    <p class="text-blue-100/60 text-xs mt-1">Usa frases sencillas en minúsculas para recordar fácilmente.</p>
                                </div>
                            </div>
                        </div>
-->
                        <div class="pt-8 border-t border-white/10">
                            <p class="text-sm text-blue-100/60 mb-3 text-center lg:text-left">¿Ya eres miembro?</p>
                            <div class="flex justify-center lg:justify-start">
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2 rounded-xl bg-white/10 text-white font-semibold hover:bg-white/20 transition-all group border border-white/10">
                                    Iniciar sesión
                                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Panel - Register Form -->
            <div class="lg:col-span-3 flex flex-col justify-center p-8 sm:p-12 lg:p-14 min-h-[600px]">
                <div class="space-y-2 mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Crear cuenta</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Completa el formulario para registrarte</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/30 border-l-4 border-red-500 rounded-r-xl" role="alert">
                        <p class="text-sm font-semibold text-red-800 dark:text-red-300">Por favor corrige los siguientes errores:</p>
                        <ul class="mt-3 text-xs text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-5 flex-1">
                    @csrf

                    <!-- Names Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nombres -->
                        <div class="space-y-2">
                            <label for="nombres" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Nombres
                            </label>
                            <input 
                                id="nombres" 
                                name="nombres" 
                                type="text" 
                                value="{{ old('nombres') }}" 
                                required 
                                autofocus
                                placeholder="Juan"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                        </div>

                        <!-- Apellidos -->
                        <div class="space-y-2">
                            <label for="apellidos" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Apellidos
                            </label>
                            <input 
                                id="apellidos" 
                                name="apellidos" 
                                type="text" 
                                value="{{ old('apellidos') }}" 
                                required
                                placeholder="Pérez"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                        </div>
                    </div>

                    <!-- Email -->
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
                                value="{{ old('email') }}" 
                                required
                                placeholder="correo@ejemplo.com"
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                            >
                        </div>
                    </div>

                    <!-- Passwords Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Contraseña -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Contraseña
                            </label>
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
                                    required
                                    placeholder="••••••••"
                                    class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                                >
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Confirmar Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    required
                                    placeholder="••••••••"
                                    class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="pt-6 mt-6 border-t border-gray-200 dark:border-slate-700">
                        <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-4 uppercase tracking-wider">Seguridad Adicional</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Pregunta Secreta -->
                            <div class="space-y-2">
                                <label for="pregunta_secreta" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Pregunta de Recuperación
                                </label>
                                <select 
                                    id="pregunta_secreta" 
                                    name="pregunta_secreta" 
                                    required
                                    onchange="toggleCustomQuestion(this.value)"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                                >
                                    <option value="" disabled {{ old('pregunta_secreta') ? '' : 'selected' }}>Seleccione una pregunta...</option>
                                    <option value="nombre_mascota" {{ old('pregunta_secreta') == 'nombre_mascota' ? 'selected' : '' }}>¿Cuál es el nombre de su primera mascota?</option>
                                    <option value="ciudad_nacimiento" {{ old('pregunta_secreta') == 'ciudad_nacimiento' ? 'selected' : '' }}>¿En qué ciudad nació?</option>
                                    <option value="color_favorito" {{ old('pregunta_secreta') == 'color_favorito' ? 'selected' : '' }}>¿Cuál es su color favorito?</option>
                                    <option value="nombre_abuela" {{ old('pregunta_secreta') == 'nombre_abuela' ? 'selected' : '' }}>¿Cuál es el nombre de su abuela materna?</option>
                                    <option value="personalizado" {{ old('pregunta_secreta') == 'personalizado' ? 'selected' : '' }}>Personalizado (Escribir mi propia pregunta)</option>
                                </select>
                            </div>

                            <!-- Respuesta Secreta -->
                            <div class="space-y-2">
                                <label for="respuesta_secreta" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Respuesta Secreta
                                </label>
                                <input 
                                    id="respuesta_secreta" 
                                    name="respuesta_secreta" 
                                    type="password" 
                                    required 
                                    autocomplete="off"
                                    oninput="this.value = this.value.toLowerCase()"
                                    placeholder="Tu respuesta (en minúsculas)"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                                >
                            </div>

                            <!-- Pregunta Personalizada (Oculta por defecto) -->
                            <div id="custom_question_container" class="space-y-2 {{ old('pregunta_secreta') == 'personalizado' ? '' : 'hidden' }} md:col-span-2">
                                <label for="pregunta_personalizada" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Escriba su pregunta personalizada
                                </label>
                                <input 
                                    id="pregunta_personalizada" 
                                    name="pregunta_personalizada" 
                                    type="text" 
                                    value="{{ old('pregunta_personalizada') }}"
                                    oninput="this.value = this.value.toLowerCase()"
                                    placeholder="Ej: ¿cuál fue el nombre de mi primer profesor?"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all duration-200"
                                >
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleCustomQuestion(value) {
                            const container = document.getElementById('custom_question_container');
                            const input = document.getElementById('pregunta_personalizada');
                            if (value === 'personalizado') {
                                container.classList.remove('hidden');
                                input.setAttribute('required', 'required');
                                input.focus();
                            } else {
                                container.classList.add('hidden');
                                input.removeAttribute('required');
                            }
                        }
                    </script>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full mt-8 py-3.5 px-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 dark:from-indigo-600 dark:to-blue-600 dark:hover:from-indigo-700 dark:hover:to-blue-700 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/40"
                    >
                        Crear Mi Cuenta
                    </button>

                    <!-- Mobile Register Link -->
                    <div class="pt-6 text-center lg:hidden">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            ¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors ml-1">
                                Iniciar sesión
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection