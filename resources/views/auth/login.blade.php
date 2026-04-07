@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700">
        <div>
            <h2 class="mt-2 text-center text-4xl font-extrabold text-blue-600 dark:text-blue-400 pb-4 tracking-tight">
                Iniciar Sesión
            </h2>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                Accede a tu agenda y organiza tu día.
            </p>
        </div>
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 mb-4 rounded-r-md" role="alert">
                <p class="text-sm font-semibold text-red-800 dark:text-red-400">Revisa los datos ingresados e intenta de nuevo.</p>
                <ul class="mt-1 list-disc list-inside text-xs text-red-700 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                        value="{{ old('email') }}" placeholder="correo@ejemplo.com">
                </div>
                
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contraseña</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm pr-20 transition-all" 
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" 
                            class="absolute inset-y-0 right-0 px-4 flex items-center text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none transition-colors">
                            Mostrar
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition duration-150 ease-in-out">
                    <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300 cursor-pointer">
                        Recordarme
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 transform hover:-translate-y-0.5">
                    Ingresar a mi Agenda
                </button>
            </div>
            
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        ¿No tienes una cuenta?
                    </span>
                </div>
            </div>

            <div>
                <a href="{{ route('register') }}" 
                    class="w-full flex justify-center py-3 px-4 border-2 border-blue-600 dark:border-blue-500 rounded-xl shadow-sm text-sm font-semibold text-blue-600 dark:text-blue-400 bg-transparent hover:bg-blue-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300">
                    Crear una cuenta nueva
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        var x = document.getElementById("password");
        var btn = event.currentTarget;
        if (x.type === "password") {
            x.type = "text";
            btn.innerText = "Ocultar";
        } else {
            x.type = "password";
            btn.innerText = "Mostrar";
        }
    }
</script>
@endsection
