@extends('layouts.sidebar')

@section('title', 'Contactos')
@section('header', 'Directorio de Contactos')

@section('content')
<div x-data="{ showDeleteModal: false, deleteActionUrl: '' }">
<!-- Controles Superiores: Buscar y Filtros -->
<form action="{{ route('contacts.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6" id="filter-form">
    <div class="flex-1 max-w-xl">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm" placeholder="Buscar por nombre, correo o teléfono...">
        </div>
    </div>
    <div class="flex items-center space-x-3">
        <!-- Filtro de Categorías -->
        <select name="categoria_id" onchange="document.getElementById('filter-form').submit()" class="py-2.5 px-4 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm appearance-none cursor-pointer">
            <option value="">Todas las Categorías</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>

        <!-- Exportar Excel -->
        <a href="{{ route('contacts.export.csv') }}" class="inline-flex items-center justify-center p-2.5 border border-green-200 dark:border-green-900/50 rounded-xl text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/40 shadow-sm transition-all" title="Exportar a Excel">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="ml-2 hidden lg:inline text-sm font-medium">Excel</span>
        </a>
        
        <!-- Exportar PDF -->
        <a href="{{ route('contacts.export.pdf') }}" class="inline-flex items-center justify-center p-2.5 border border-red-200 dark:border-red-900/50 rounded-xl text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 shadow-sm transition-all" title="Exportar a PDF">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            <span class="ml-2 hidden lg:inline text-sm font-medium">PDF</span>
        </a>
        
        <a href="{{ route('contacts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Contacto
        </a>
    </div>
</form>

<!-- Listado de Contactos (Grid de Tarjetas) -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    
    @forelse($contactos as $contacto)
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-xl shadow-gray-200/50 dark:shadow-none hover:border-indigo-300 dark:hover:border-indigo-500/50 transition-all group relative overflow-hidden">
        <!-- Badge de Categoría con Color -->
        <div class="absolute top-0 right-0 w-2 h-full" style="background-color: {{ $contacto->categoria->color ?? '#6366f1' }}"></div>

        <div class="flex items-start justify-between">
            <div class="flex items-center space-x-4">
                @if($contacto->foto_path)
                    <img src="{{ asset('storage/' . $contacto->foto_path) }}" alt="{{ $contacto->nombres }}" class="w-14 h-14 rounded-full object-cover border-2 border-white dark:border-slate-700 shadow-sm">
                @else
                    <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold text-white shadow-sm" style="background-color: {{ $contacto->categoria->color ?? '#6366f1' }}">
                        {{ substr($contacto->nombres, 0, 1) }}
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $contacto->nombres }} {{ $contacto->apellidos }}
                    </h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1" style="background-color: {{ ($contacto->categoria->color ?? '#6366f1') }}20; color: {{ $contacto->categoria->color ?? '#6366f1' }}">
                        {{ $contacto->categoria->nombre ?? 'Sin categoría' }}
                    </span>
                </div>
            </div>
            
            <!-- Acciones -->
            <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('contacts.show', $contacto->id) }}" class="p-1.5 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/50 transition-colors" title="Ver detalle">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </a>
                <a href="{{ route('contacts.edit', $contacto->id) }}" class="p-1.5 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/50 transition-colors" title="Editar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <button type="button" @click="deleteActionUrl = '{{ route('contacts.destroy', $contacto->id) }}'; showDeleteModal = true" class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/50 transition-colors" title="Eliminar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </div>
        <div class="mt-4 space-y-2">
            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                @if($contacto->telefonos->count() > 0)
                    {{ $contacto->telefonos->first()->numero }}
                @else
                    Sin teléfono
                @endif
            </div>
            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                {{ $contacto->email ?? 'Sin correo electrónico' }}
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-slate-800 mb-4 text-gray-400">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">No se encontraron contactos</h3>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Prueba ajustando tus filtros o crea uno nuevo.</p>
    </div>
    @endforelse

</div>

<!-- Paginación -->
<div class="mt-8">
    {{ $contactos->appends(request()->query())->links() }}
</div>

<!-- Modal de Confirmación de Eliminación (Alpine.js) -->
<div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 dark:bg-slate-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="showDeleteModal" @click.away="showDeleteModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-slate-700">
            <div class="bg-white dark:bg-slate-800 px-6 pt-6 pb-4">
                <div class="flex flex-col items-center sm:flex-row sm:items-start gap-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">Eliminar Contacto</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">¿Estás seguro de que deseas eliminar este contacto? Esta acción no se puede deshacer y los datos se perderán permanentemente.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 dark:bg-slate-800/50 px-6 py-4 flex flex-row-reverse items-stretch gap-3 border-t border-gray-100 dark:border-slate-700">
                <form :action="deleteActionUrl" method="POST" class="flex-1 flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-4 py-2.5 bg-red-600 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Sí, eliminar
                    </button>
                </form>
                
                <button type="button" @click="showDeleteModal = false" class="flex-1 inline-flex justify-center items-center rounded-xl border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2.5 bg-white dark:bg-slate-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
