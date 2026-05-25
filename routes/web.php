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
    // Exportación de Contactos
    Route::get('/contacts/export/csv', [App\Http\Controllers\ContactoController::class, 'exportCsv'])->name('contacts.export.csv');
    Route::get('/contacts/export/pdf', [App\Http\Controllers\ContactoController::class, 'exportPdf'])->name('contacts.export.pdf');

    Route::get('/contacts', [App\Http\Controllers\ContactoController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [App\Http\Controllers\ContactoController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [App\Http\Controllers\ContactoController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contacto}', [App\Http\Controllers\ContactoController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contacto}/edit', [App\Http\Controllers\ContactoController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contacto}', [App\Http\Controllers\ContactoController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contacto}', [App\Http\Controllers\ContactoController::class, 'destroy'])->name('contacts.destroy');
    
    // Categorías
    Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorias.store');
    Route::put('/categorias/{categoria}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/categorias/{categoria}/contactos', [App\Http\Controllers\CategoriaController::class, 'getContactos'])->name('categorias.contactos');
    
    // Usuarios (Solo Administradores, excepto edit y update para perfil propio)
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['edit', 'update'])->middleware(['admin']);
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    
    // Ayuda
    Route::view('/help/about', 'help.about')->name('help.about');
});

require __DIR__.'/auth.php';
