<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            // Si el usuario no es admin, abortamos con 403 o redirigimos. 
            // Abortar con 403 (Acceso Denegado) es estándar.
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
