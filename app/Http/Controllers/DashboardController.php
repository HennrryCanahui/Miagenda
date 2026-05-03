<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin ve estadísticas globales
            $stats = [
                'total_contactos' => Contacto::count(),
                'total_categorias' => Categoria::count(),
                'nuevos_mes' => Contacto::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count(),
                'total_usuarios' => User::count(),
            ];
        } else {
            // Usuario estándar ve solo sus estadísticas
            $stats = [
                'total_contactos' => Contacto::where('usuario_id', $user->id)->count(),
                'total_categorias' => Categoria::where('usuario_id', $user->id)->count(),
                'nuevos_mes' => Contacto::where('usuario_id', $user->id)
                                        ->whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count(),
                'total_usuarios' => null, // No aplica para estándar
            ];
        }

        return view('dashboard', compact('stats'));
    }
}
