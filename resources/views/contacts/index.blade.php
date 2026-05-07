@extends('layouts.sidebar')

@section('title', 'Contactos')
@section('header', 'Directorio de Contactos')

@section('content')
<!-- Controles Superiores: Buscar y Filtros -->
<form action="{{ route('contacts.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6" id="filter-form">
    <div class="flex-1 max-w-xl">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm" placeholder="Buscar por nombre o correo...">
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
        
        <a href="{{ route('contacts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Contacto
        </a>
    </div>
</form>

<!-- Listado de Contactos (Grid de Tarjetas) -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    
    @forelse($contactos as $contacto)
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-xl shadow-slate-200/20 dark:shadow-none hover:border-indigo-300 dark:hover:border-indigo-500/50 transition-all group relative overflow-hidden">
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
                <button class="p-1.5 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/50 transition-colors" title="Editar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
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
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-slate-900 mb-4 text-gray-400">
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

@endsection
