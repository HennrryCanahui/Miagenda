@extends('layouts.sidebar')

@section('title', 'Gestión de Categorías')
@section('header', 'Categorías')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Columna Izquierda: Listado -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Categorías Existentes</h2>
            
            <!-- Barra de búsqueda rápida -->
            <div class="relative w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="buscar-categoria" class="w-full pl-9 pr-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm" placeholder="Buscar categoría...">
            </div>
        </div>

        <!-- Alertas -->
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-4">
                <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-4">
                <p class="text-sm font-medium text-green-800 dark:text-green-300">
                    ✓ {{ session('success') }}
                </p>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/20 dark:shadow-none border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                    <thead class="bg-gray-50 dark:bg-slate-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Categoría</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tipo</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contactos</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700 bg-white dark:bg-slate-800" id="tabla-categorias">
                        @forelse($categorias as $categoria)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group categoria-row" data-categoria-nombre="{{ strtolower($categoria->nombre) }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center border" style="border-color: {{ $categoria->color }}80; background-color: {{ $categoria->color }}20; color: {{ $categoria->color }};">
                                        @if($categoria->icono)
                                            @if(str_starts_with($categoria->icono, 'preset:'))
                                                @php $presetName = str_replace('preset:', '', $categoria->icono); @endphp
                                                <div class="w-6 h-6 flex items-center justify-center preset-icon-display" data-icon="{{ $presetName }}">
                                                    <!-- Se cargará por JS para consistencia -->
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $categoria->icono) }}" class="w-6 h-6 object-cover rounded" alt="{{ $categoria->nombre }}" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                                <svg class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            @endif
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $categoria->nombre }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $categoria->color }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($categoria->es_predefinida)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                        Sistema
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300">
                                        Personalizada
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col space-y-1">
                                    <button onclick="verContactos({{ $categoria->id }}, '{{ $categoria->nombre }}')" class="text-left hover:text-indigo-600 dark:hover:text-indigo-400 underline transition-colors">
                                        {{ $categoria->contactos()->where('usuario_id', auth()->id())->count() }} contactos
                                    </button>
                                    <a href="/contacts?categoria_id={{ $categoria->id }}" class="text-xs text-gray-400 hover:text-indigo-500 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Ver en Directorio
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if(!$categoria->es_predefinida)
                                    <div class="flex justify-end items-center space-x-2">
                                        <button onclick="editCategoria({{ $categoria->id }}, '{{ addslashes($categoria->nombre) }}', '{{ $categoria->color }}', '{{ $categoria->icono }}')" class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition" title="Eliminar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Solo lectura</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400 italic">
                                No se encontraron categorías.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Paginación -->
            @if($categorias->hasPages())
                <div class="bg-gray-50 dark:bg-slate-900/50 px-6 py-3 border-t border-gray-200 dark:border-slate-700">
                    {{ $categorias->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Columna Derecha: Formulario -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-indigo-500/5 border border-gray-100 dark:border-slate-700 overflow-hidden sticky top-24">
            <div class="p-6 border-b border-gray-100 dark:border-slate-700 bg-gradient-to-r from-gray-50 to-white dark:from-slate-800 dark:to-slate-800">
                <h3 id="form-title" class="text-lg font-bold text-gray-900 dark:text-white">Crear Categoría</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Organiza tus contactos en grupos</p>
            </div>
            
            <form id="categoria-form" action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <!-- Nombre -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="nombre" id="form-nombre" required placeholder="Ej. Familia, Trabajo..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>

                <!-- Color -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="color" id="form-color" required value="#6366f1" class="h-10 w-14 p-1 rounded-lg cursor-pointer bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700">
                        <div class="h-10 w-full rounded-lg border border-gray-200 dark:border-slate-700 shadow-inner" id="color-preview" style="background-color: #6366f1;"></div>
                    </div>
                </div>

                <!-- Selector de Iconos Predefinidos -->
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Seleccionar Ícono del Menú</label>
                    <input type="hidden" name="icono_preset" id="form-icono-preset" value="">
                    
                    <!-- Botón toggle -->
                    <button type="button" id="icon-picker-toggle" onclick="toggleIconPicker()" 
                        class="w-full flex items-center justify-between px-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:border-indigo-400 transition-all">
                        <div class="flex items-center space-x-2">
                            <div id="selected-icon-preview" class="w-5 h-5 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <span id="selected-icon-label">Sin ícono seleccionado</span>
                        </div>
                        <svg id="icon-picker-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Picker colapsable -->
                    <div id="icon-picker-wrapper" class="hidden">
                        <div class="grid grid-cols-6 gap-2 p-3 bg-gray-50 dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-700 max-h-48 overflow-y-auto" id="icon-picker">
                            <!-- Generado por JS -->
                        </div>
                    </div>
                </div>

                <!-- Separador -->
                <div class="relative py-2">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200 dark:border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white dark:bg-slate-800 px-2 text-gray-500 font-bold">O sube tu imagen</span>
                    </div>
                </div>

                <!-- Subir Imagen -->
                <div class="space-y-2">
                    <div class="relative group">
                        <input type="file" name="icono" id="form-icono" accept="image/*" class="hidden">
                        <label for="form-icono" class="flex items-center justify-center w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-500/10 transition-all">
                            <div class="text-center">
                                <svg class="mx-auto h-6 w-6 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="mt-1 text-xs text-gray-500">Click para subir</p>
                            </div>
                        </label>
                        <div id="icono-preview" class="mt-2 hidden flex items-center justify-between p-2 bg-indigo-50 dark:bg-indigo-500/10 rounded-lg border border-indigo-100 dark:border-indigo-500/20">
                            <div class="flex items-center space-x-3">
                                <img id="preview-img" src="" alt="Preview" class="w-8 h-8 rounded-lg object-cover border border-white shadow-sm">
                                <span class="text-xs font-medium text-indigo-700 dark:text-indigo-300">Imagen personalizada</span>
                            </div>
                            <button type="button" onclick="limpiarIcono()" class="text-red-500 hover:text-red-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-4 space-y-3">
                    <button type="submit" id="form-submit" class="w-full py-3.5 px-4 rounded-xl font-bold text-white transition-all duration-300 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0">
                        Guardar Categoría
                    </button>
                    <button type="button" onclick="resetForm()" class="w-full py-3 px-4 rounded-xl font-medium text-gray-600 dark:text-gray-400 bg-transparent hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                        Cancelar / Limpiar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Contactos -->
<div id="modal-contactos" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" aria-hidden="true" onclick="cerrarModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="p-6 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between bg-gradient-to-r from-gray-50 to-white dark:from-slate-800 dark:to-slate-800">
                <h3 id="modal-titulo" class="text-xl font-bold text-gray-900 dark:text-white">Contactos</h3>
                <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="modal-contenido" class="p-6 max-h-[60vh] overflow-y-auto"></div>
            <div class="bg-gray-50 dark:bg-slate-900/50 px-6 py-4 flex justify-end">
                <button onclick="cerrarModal()" class="px-6 py-2.5 rounded-xl bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-600 transition-all">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Configuración de Iconos Predefinidos
    const PRESET_ICONS = {
        'home': '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
        'work': '<path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745V6a2 2 0 012-2h2a2 2 0 012 2v1h4V6a2 2 0 012-2h2a2 2 0 012 2v7.255zM12 8a1 1 0 100-2 1 1 0 000 2z" />',
        'users': '<path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 00-7 7v1h11v-1a6.97 6.97 0 00-1.5-4.33A5 5 0 019 11z" />',
        'star': '<path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />',
        'heart': '<path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />',
        'phone': '<path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />',
        'mail': '<path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
        'calendar': '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
        'location': '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
        'cart': '<path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />',
        'school': '<path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />',
        'tag': '<path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />'
    };

    const ICON_LABELS = {
        'home': 'Inicio', 'work': 'Trabajo', 'users': 'Personas', 'star': 'Favorito',
        'heart': 'Corazón', 'phone': 'Teléfono', 'mail': 'Correo', 'calendar': 'Calendario',
        'location': 'Ubicación', 'cart': 'Tienda', 'school': 'Estudios', 'tag': 'Etiqueta'
    };
    function toggleIconPicker() {
        const wrapper = document.getElementById('icon-picker-wrapper');
        const arrow = document.getElementById('icon-picker-arrow');
        const isHidden = wrapper.classList.contains('hidden');
        wrapper.classList.toggle('hidden', !isHidden);
        arrow.style.transform = isHidden ? 'rotate(180deg)' : '';
    }

    function selectPresetIcon(key) {
        document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-100', 'dark:bg-indigo-900/50'));
        const selected = document.querySelector(`.icon-option[data-key="${key}"]`);
        if (selected) {
            selected.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-100', 'dark:bg-indigo-900/50');
            document.getElementById('form-icono-preset').value = key;
            document.getElementById('form-icono').value = '';
            document.getElementById('icono-preview').classList.add('hidden');

            // Actualizar botón toggle
            document.getElementById('selected-icon-preview').innerHTML = `<svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">${PRESET_ICONS[key]}</svg>`;
            document.getElementById('selected-icon-label').textContent = ICON_LABELS[key] || key;
            document.getElementById('selected-icon-label').classList.add('text-indigo-600', 'dark:text-indigo-400');

            // Cerrar picker
            document.getElementById('icon-picker-wrapper').classList.add('hidden');
            document.getElementById('icon-picker-arrow').style.transform = '';
        }
    }
    
    // Renderizar Picker e Iconos en Tabla
    function initIcons() {
        const picker = document.getElementById('icon-picker');
        picker.innerHTML = '';
        
        Object.keys(PRESET_ICONS).forEach(key => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'p-2 flex items-center justify-center rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 border border-transparent transition-all icon-option';
            btn.dataset.key = key;
            btn.innerHTML = `<svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">${PRESET_ICONS[key]}</svg>`;
            
            btn.onclick = () => selectPresetIcon(key);
            picker.appendChild(btn);
        });

        document.querySelectorAll('.preset-icon-display').forEach(div => {
            const key = div.dataset.icon;
            if (PRESET_ICONS[key]) {
                div.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">${PRESET_ICONS[key]}</svg>`;
            }
        });
    }

    function selectPresetIcon(key) {
        document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-100'));
        const selected = document.querySelector(`.icon-option[data-key="${key}"]`);
        if (selected) {
            selected.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-100');
            document.getElementById('form-icono-preset').value = key;
            // Limpiar file input para evitar conflicto
            document.getElementById('form-icono').value = '';
            document.getElementById('icono-preview').classList.add('hidden');
        }
    }

    // Búsqueda en tiempo real
    document.getElementById('buscar-categoria').addEventListener('input', function(e) {
        const termino = e.target.value.toLowerCase();
        const filas = document.querySelectorAll('.categoria-row');
        filas.forEach(fila => {
            const nombre = fila.getAttribute('data-categoria-nombre');
            fila.style.display = nombre.includes(termino) ? '' : 'none';
        });
    });

    // Preview de color
    document.getElementById('form-color').addEventListener('input', function(e) {
        document.getElementById('color-preview').style.backgroundColor = e.target.value;
    });

    // Preview de ícono archivo
    document.getElementById('form-icono').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-img').src = event.target.result;
                document.getElementById('icono-preview').classList.remove('hidden');
                // Limpiar preset
                document.getElementById('form-icono-preset').value = '';
                document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-100'));
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    function limpiarIcono() {
        document.getElementById('form-icono').value = '';
        document.getElementById('icono-preview').classList.add('hidden');
    }

    function editCategoria(id, nombre, color, icono) {
        document.getElementById('form-title').innerText = 'Editar Categoría';
        
        // CORRECCIÓN: La URL debe incluir el ID para que coincida con la ruta PUT de Laravel
        document.getElementById('categoria-form').action = '/categorias/' + id; 
        
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('form-nombre').value = nombre;
        document.getElementById('form-color').value = color;
        document.getElementById('color-preview').style.backgroundColor = color;
        document.getElementById('form-submit').innerText = 'Actualizar Categoría';
        
        // Manejar icono actual
        if (icono && icono.startsWith('preset:')) {
            selectPresetIcon(icono.replace('preset:', ''));
        } else {
            limpiarIcono();
            document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-100'));
            document.getElementById('form-icono-preset').value = '';
        }

        document.getElementById('categoria-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function resetForm() {
        document.getElementById('form-title').innerText = 'Crear Categoría';
        document.getElementById('categoria-form').action = '{{ route('categorias.store') }}';
        document.getElementById('form-method').value = 'POST';
        document.getElementById('form-nombre').value = '';
        document.getElementById('form-color').value = '#6366f1';
        document.getElementById('color-preview').style.backgroundColor = '#6366f1';
        document.getElementById('form-submit').innerText = 'Guardar Categoría';
        document.getElementById('form-icono-preset').value = '';
        document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-100'));
        limpiarIcono();
        document.getElementById('selected-icon-preview').innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>`;
        document.getElementById('selected-icon-label').textContent = 'Sin ícono seleccionado';
        document.getElementById('selected-icon-label').classList.remove('text-indigo-600', 'dark:text-indigo-400');
        document.getElementById('icon-picker-wrapper').classList.add('hidden');
        document.getElementById('icon-picker-arrow').style.transform = '';
    }

    function verContactos(id, nombre) {
        const modal = document.getElementById('modal-contactos');
        const contenido = document.getElementById('modal-contenido');
        const titulo = document.getElementById('modal-titulo');
        titulo.innerText = 'Contactos en "' + nombre + '"';
        contenido.innerHTML = '<div class="flex justify-center py-10"><svg class="animate-spin h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';
        modal.classList.remove('hidden');
        
        fetch('/categorias/' + id + '/contactos')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.contactos.length > 0) {
                    let html = '<div class="space-y-3">';
                    data.contactos.forEach(c => {
                        html += `
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-900/50 rounded-2xl border border-gray-100 dark:border-slate-700">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                        ${c.nombre.charAt(0).toUpperCase()}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">${c.nombre}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">${c.email || 'Sin correo'}</p>
                                    </div>
                                </div>
                                <a href="/contacts/${c.id}" class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>`;
                    });
                    html += '</div>';
                    contenido.innerHTML = html;
                } else {
                    contenido.innerHTML = '<div class="text-center py-10 text-gray-500">No hay contactos.</div>';
                }
            });
    }

    function cerrarModal() { document.getElementById('modal-contactos').classList.add('hidden'); }
    document.addEventListener('DOMContentLoaded', initIcons);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') cerrarModal(); });
</script>
@endsection
