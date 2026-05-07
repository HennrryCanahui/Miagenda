<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Rutas temporales (Mockups) para la demostración de la Agenda
Route::middleware(['auth'])->group(function () {
    
    // Contactos
    Route::get('/contacts', [App\Http\Controllers\ContactoController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [App\Http\Controllers\ContactoController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [App\Http\Controllers\ContactoController::class, 'store'])->name('contacts.store');
    // Las rutas de edit/delete usarán lógica más adelante
    
    // Categorías
    Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorias.store');
    Route::put('/categorias/{categoria}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/categorias/{categoria}/contactos', [App\Http\Controllers\CategoriaController::class, 'getContactos'])->name('categorias.contactos');
    
    // Usuarios (Solo Administradores)
    Route::view('/users', 'users.index')->name('users.index')->middleware(['admin']);
    
    // Ayuda
    Route::view('/help/about', 'help.about')->name('help.about');
});

require __DIR__.'/auth.php';
