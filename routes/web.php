<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('welcome');
    }
    return redirect()->route('login');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth'])->name('welcome');

require __DIR__.'/auth.php';
