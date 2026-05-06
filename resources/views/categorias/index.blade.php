@extends('layouts.sidebar')

@section('title', 'Gestión de Categorías')
@section('header', 'Categorías')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Columna Izquierda: Listado -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Categorías Existentes</h2>
            
            <!-- Barra de búsqueda rápida para categorías -->
            <div class="relative w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="w-full pl-9 pr-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Buscar categoría...">
            </div>
        </div>

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
                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700 bg-white dark:bg-slate-800">
                        @forelse($categorias as $categoria)
                        <!-- Categoría -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center border" style="border-color: {{ $categoria->color }}80; background-color: {{ $categoria->color }}20; color: {{ $categoria->color }};">
                                        @if($categoria->icono && !str_starts_with($categoria->icono, 'default'))
                                            <img src="{{ asset('storage/' . $categoria->icono) }}" class="w-6 h-6 object-cover rounded" alt="{{ $categoria->nombre }}">
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $categoria->nombre }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $categoria->color }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300">
                                    Personalizada
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $categoria->contactos()->count() }} contactos
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-2">
                                <button onclick="editCategoria({{ $categoria->id }}, '{{ $categoria->nombre }}', '{{ $categoria->color }}')" class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 mx-1" title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 mx-1" title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No hay categorías registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Paginación -->
            <div class="bg-gray-50 dark:bg-slate-900/50 px-6 py-3 border-t border-gray-200 dark:border-slate-700">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>

    <!-- Columna Derecha: Formulario Crear/Editar -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-indigo-500/5 border border-gray-100 dark:border-slate-700 overflow-hidden sticky top-24">
            <div class="p-6 border-b border-gray-100 dark:border-slate-700 bg-gradient-to-r from-gray-50 to-white dark:from-slate-800 dark:to-slate-800">
                <h3 id="form-title" class="text-lg font-bold text-gray-900 dark:text-white">Crear Categoría</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Define un grupo para organizar contactos</p>
            </div>
            
            <form id="categoria-form" action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <!-- Nombre -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre de la Categoría</label>
                    <input type="text" name="nombre" id="form-nombre" required placeholder="Ej. Proveedores" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>

                <!-- Color -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Color Representativo</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="color" id="form-color" required value="#6366f1" class="h-10 w-14 p-1 rounded bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 cursor-pointer">
                    </div>
                </div>

                <!-- Icono -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Seleccionar Imagen (Opcional)</label>
                    <input type="file" name="icono" accept="image/*" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <p class="text-xs text-gray-500">Puedes subir un ícono o imagen personalizada (PNG, JPG, SVG).</p>
                </div>

                <div class="pt-4">
                    <button type="submit" id="form-submit" class="w-full py-3 px-4 rounded-xl font-bold text-white transition-all duration-300 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 hover:-translate-y-0.5">
                        Guardar Categoría
                    </button>
                    <button type="button" onclick="resetForm()" class="w-full mt-2 py-3 px-4 rounded-xl font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                        Cancelar / Limpiar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editCategoria(id, nombre, color) {
        document.getElementById('form-title').innerText = 'Editar Categoría';
        document.getElementById('categoria-form').action = '{{ url('/categorias') }}/' + id;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('form-nombre').value = nombre;
        document.getElementById('form-color').value = color;
        document.getElementById('form-submit').innerText = 'Actualizar Categoría';
    }

    function resetForm() {
        document.getElementById('form-title').innerText = 'Crear Categoría';
        document.getElementById('categoria-form').action = '{{ route('categorias.store') }}';
        document.getElementById('form-method').value = 'POST';
        document.getElementById('form-nombre').value = '';
        document.getElementById('form-color').value = '#6366f1';
        document.getElementById('form-submit').innerText = 'Guardar Categoría';
    }
</script>
@endsection
