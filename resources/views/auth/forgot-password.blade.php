@extends('layouts.guest')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl max-h-[90vh] ">
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
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Restablecer Contraseña</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Verifica tu identidad respondiendo a tu pregunta secreta</p>
                </div>

                <div id="error-container" class="{{ $errors->any() ? '' : 'hidden' }} mb-6 p-4 bg-red-50 dark:bg-red-950/30 border-l-4 border-red-500 rounded-r-xl" role="alert">
                    <ul id="error-list" class="text-xs text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                
                <div id="lockout-message" class="mb-4 p-4 border-l-4 border-amber-500 rounded-r-xl" role="alert">
                    <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">
                        Demasiados intentos fallidos. Por favor, espera <span id="lockout-timer">60</span> segundos para intentar de nuevo.
                    </p>
                </div>

                <form id="forgot-password-form" action="{{ route('password.email') }}" method="POST" class="space-y-5 flex-1">
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
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all focus:outline-none"
                        >
                            <option value="" disabled selected>Seleccione una pregunta...</option>
                            <option value="nombre_mascota">¿Cuál es el nombre de su primera mascota?</option>
                            <option value="ciudad_nacimiento">¿En qué ciudad nació?</option>
                            <option value="color_favorito">¿Cuál es su color favorito?</option>
                            <option value="nombre_abuela">¿Cuál es el nombre de su abuela materna?</option>
                            <option value="personalizado">Personalizado (Escribir mi propia pregunta)</option>
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
                            type="text" 
                            required 
                            autocomplete="off"
                            oninput="this.value = this.value.toLowerCase()"
                            placeholder="Tu respuesta (en minúsculas)"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                        >
                    </div>

                    <!-- Pregunta Personalizada (Oculta por defecto) -->
                    <div id="custom_question_container" class="space-y-2 hidden">
                        <label for="pregunta_personalizada" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Escriba su pregunta personalizada
                        </label>
                        <input 
                            id="pregunta_personalizada" 
                            name="pregunta_personalizada" 
                            type="text" 
                            oninput="this.value = this.value.toLowerCase()"
                            placeholder="Ej: ¿cuál fue el nombre de mi primer profesor?"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Contraseña -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Nueva Contraseña
                            </label>
                            <input 
                                id="password" 
                                name="password" 
                                type="text" 
                                required
                                placeholder="••••••••"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                            >
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Confirmar Contraseña
                            </label>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="text" 
                                required
                                placeholder="••••••••"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                            >
                        </div>
                    </div>

                    <button 
                        id="submit-btn"
                        type="submit" 
                        class="w-full mt-6 py-3.5 px-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/40"
                    >
                        Restablecer Contraseña
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

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('forgot-password-form');
        const submitBtn = document.getElementById('submit-btn');
        const lockoutMessage = document.getElementById('lockout-message');
        const lockoutTimer = document.getElementById('lockout-timer');
        
        let attempts = parseInt(localStorage.getItem('forgotAttempts') || '0');
        let lockoutUntil = parseInt(localStorage.getItem('forgotLockoutUntil') || '0');
        
        function updateLockout() {
            const now = Date.now();
            if (lockoutUntil > now) {
                const remaining = Math.ceil((lockoutUntil - now) / 1000);
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                lockoutMessage.classList.remove('hidden');
                lockoutTimer.textContent = remaining;
                
                setTimeout(updateLockout, 1000);
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                lockoutMessage.classList.add('hidden');
                if (lockoutUntil > 0) {
                    localStorage.removeItem('forgotLockoutUntil');
                    localStorage.setItem('forgotAttempts', '0');
                }
            }
        }

        updateLockout();

        function showErrors(errors) {
            const errorContainer = document.getElementById('error-container');
            const errorList = document.getElementById('error-list');
            errorList.innerHTML = '';
            
            if (typeof errors === 'string') {
                const li = document.createElement('li');
                li.textContent = errors;
                errorList.appendChild(li);
            } else {
                Object.values(errors).forEach(messages => {
                    (Array.isArray(messages) ? messages : [messages]).forEach(msg => {
                        const li = document.createElement('li');
                        li.textContent = msg;
                        errorList.appendChild(li);
                    });
                });
            }
            
            errorContainer.classList.remove('hidden');
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (lockoutUntil > Date.now()) return;

            document.getElementById('error-container').classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-wait');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Verificando...';

            const formData = new FormData(form);
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                if (response.ok) {
                    localStorage.setItem('forgotAttempts', '0');
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const data = await response.json();
                        window.location.href = data.redirect || '{{ route("login") }}';
                    } else {
                        window.location.href = response.url || '{{ route("login") }}';
                    }
                } else {
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const data = await response.json();
                        
                        let errorToShow = data.errors;
                        
                        if (!errorToShow) {
                            if (data.message && data.message.includes('Too Many Attempts')) {
                                errorToShow = 'Ups, has intentado muchas veces. Por favor, espera un momento y vuelve a intentar.';
                            } else if (data.message && data.message.includes('The given data was invalid')) {
                                errorToShow = 'Revisa que los datos ingresados sean correctos.';
                            } else if (data.message && data.message.includes('Server Error')) {
                                errorToShow = 'Hubo un problema en el servidor. Por favor, intenta de nuevo más tarde.';
                            } else {
                                errorToShow = data.message || 'Ups, algo salió mal al restablecer tu contraseña. Intenta de nuevo.';
                            }
                        }
                        
                        showErrors(errorToShow);
                    } else {
                        showErrors('Ups, hubo un error de conexión con el servidor. Por favor intenta de nuevo.');
                    }
                    
                    attempts++;
                    localStorage.setItem('forgotAttempts', attempts);
                    
                    if (attempts >= 3) {
                        const lockoutTime = Date.now() + 60000;
                        localStorage.setItem('forgotLockoutUntil', lockoutTime);
                        lockoutUntil = lockoutTime;
                        updateLockout();
                    }
                }
            } catch (error) {
                console.error('Reset error:', error);
                if (error instanceof TypeError) {
                    showErrors('Ups, parece que hay un problema de conexión. Por favor revisa tu internet e intenta de nuevo.');
                } else {
                    window.location.href = '{{ route("login") }}';
                }
            } finally {
                if (lockoutUntil <= Date.now()) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-wait');
                    submitBtn.textContent = originalText;
                }
            }
        });
    });
</script>
@endsection
