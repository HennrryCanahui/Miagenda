@extends('layouts.sidebar')

@section('title', 'Agregar Contacto')
@section('header', 'Nuevo Contacto')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('contacts.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al Directorio
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-indigo-500/5 dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
        
        <form action="#" method="POST" enctype="multipart/form-data" class="p-8 sm:p-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Columna Izquierda: Foto de Perfil -->
                <div class="flex flex-col items-center space-y-4">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-full border-4 border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900 overflow-hidden flex items-center justify-center shadow-inner relative z-10">
                            <!-- Placeholder -->
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        
                        <!-- Botón superpuesto para cambiar foto -->
                        <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20 cursor-pointer">
                            <label for="photo" class="cursor-pointer text-white flex flex-col items-center">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-xs font-medium">Subir foto</span>
                            </label>
                            <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">Formatos: JPG, PNG, WEBP. <br>Máx. 2MB</p>
                </div>

                <!-- Columna Derecha: Datos -->
                <div class="md:col-span-2 space-y-6">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nombres</label>
                            <input type="text" placeholder="Ej. Juan Carlos" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                        
                        <!-- Apellidos -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Apellidos</label>
                            <input type="text" placeholder="Ej. Pérez" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Teléfono -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Teléfono Principal</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="tel" placeholder="+502" class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="email" placeholder="correo@ejemplo.com" class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Categoría -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Asignar Categoría</label>
                        <select class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all appearance-none">
                            <option value="" disabled selected>Seleccione una categoría</option>
                            <option value="1">Trabajo</option>
                            <option value="2">Familia</option>
                            <option value="3">Amigos</option>
                            <option value="4">Emergencias</option>
                        </select>
                    </div>

                    <!-- Dirección -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Dirección Física (Opcional)</label>
                        <textarea rows="2" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 dark:border-slate-700">
                        <a href="{{ route('contacts.index') }}" class="px-6 py-2.5 rounded-xl font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                            Guardar Contacto
                        </button>
                    </div>

                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
