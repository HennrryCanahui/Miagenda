@extends('layouts.sidebar')

@section('title', 'Acerca de')
@section('header', 'Ayuda y Soporte')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl shadow-indigo-500/10 dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden relative">
        
        <!-- Header Art / Carátula -->
        <div class="h-48 md:h-64 bg-gradient-to-br from-indigo-900 via-blue-900 to-slate-900 relative overflow-hidden flex items-center justify-center">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl -ml-32 -mb-32"></div>
            
            <div class="relative z-10 text-center">
                <div class="mx-auto w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 flex items-center justify-center mb-4 shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">MyAgenda</h1>
                <p class="text-blue-100/80 text-sm md:text-base mt-2 font-medium">Sistema Inteligente de Contactos</p>
            </div>
        </div>

        <div class="p-8 md:p-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Info Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Información del Sistema</h3>
                        <dl class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex justify-between border-b border-gray-100 dark:border-slate-700 pb-2">
                                <dt class="font-medium text-gray-700 dark:text-gray-300">Versión:</dt>
                                <dd>1.0.0 (BETA Demo)</dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 dark:border-slate-700 pb-2">
                                <dt class="font-medium text-gray-700 dark:text-gray-300">Framework:</dt>
                                <dd>Laravel 11.x</dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 dark:border-slate-700 pb-2">
                                <dt class="font-medium text-gray-700 dark:text-gray-300">Estilos:</dt>
                                <dd>Tailwind CSS 3</dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 dark:border-slate-700 pb-2">
                                <dt class="font-medium text-gray-700 dark:text-gray-300">SO Soportados:</dt>
                                <dd>Linux, FreeBSD, Windows, macOS</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Features Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Módulos Implementados</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Directorio de Contactos (Fotos, Datos)</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Gestión de Categorías con iconos y colores</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Mantenimiento de Usuarios y Roles</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Interfaz adaptable (Oscuro/Claro)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100 dark:border-slate-700 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} MyAgenda. Todos los derechos reservados.<br>
                    Desarrollado como demostración de maquetación y diseño de interfaces.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
