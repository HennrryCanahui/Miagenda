<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where(function($query) {
            $query->where('usuario_id', Auth::id())
                  ->orWhere('es_predefinida', true);
        })
        ->orderBy('es_predefinida', 'desc')
        ->orderBy('nombre', 'asc')
        ->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'required|string|size:7',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        // Verificar si ya existe una categoría con ese nombre para este usuario
        $existe = Categoria::where('usuario_id', Auth::id())
            ->where('nombre', $request->nombre)
            ->exists();

        if ($existe) {
            return back()->withErrors(['nombre' => 'Ya tienes una categoría guardada con este nombre. Intenta con uno diferente.']);
        }

        $data = $request->all();
        $data['usuario_id'] = Auth::id();
        $data['es_predefinida'] = false;

        if ($request->hasFile('icono')) {
            $path = $request->file('icono')->store('categorias', 'public');
            $data['icono'] = $path;
        } elseif ($request->filled('icono_preset')) {
            $data['icono'] = 'preset:' . $request->icono_preset;
        }

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('success', '¡Genial! La categoría se ha guardado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // No permitir editar categorías de otros usuarios
        if ($categoria->usuario_id !== Auth::id()) {
            return back()->withErrors(['auth' => 'Ups, parece que esta categoría no te pertenece.']);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'required|string|size:7',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        $data = $request->only(['nombre', 'color']);

        if ($request->hasFile('icono')) {
            // Eliminar icono anterior si existe y es un archivo
            if ($categoria->icono && !str_starts_with($categoria->icono, 'preset:') && Storage::disk('public')->exists($categoria->icono)) {
                Storage::disk('public')->delete($categoria->icono);
            }
            
            $path = $request->file('icono')->store('categorias', 'public');
            $data['icono'] = $path;
        } elseif ($request->filled('icono_preset')) {
            // Si el usuario eligió un preset, eliminamos la imagen anterior si existía
            if ($categoria->icono && !str_starts_with($categoria->icono, 'preset:') && Storage::disk('public')->exists($categoria->icono)) {
                Storage::disk('public')->delete($categoria->icono);
            }
            $data['icono'] = 'preset:' . $request->icono_preset;
        }

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('success', '¡Perfecto! Los cambios de la categoría se han guardado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        // No permitir eliminar categorías de otros usuarios
        if ($categoria->usuario_id !== Auth::id()) {
            return back()->withErrors(['auth' => 'Ups, parece que esta categoría no te pertenece.']);
        }

        // Eliminar icono si existe y es un archivo
        if ($categoria->icono && !str_starts_with($categoria->icono, 'preset:') && Storage::disk('public')->exists($categoria->icono)) {
            Storage::disk('public')->delete($categoria->icono);
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido eliminada sin problemas.');
    }

    /**
     * Obtener contactos de una categoría vía AJAX.
     */
    public function getContactos(Categoria $categoria)
    {
        // Verificar que la categoría pertenezca al usuario o sea predefinida
        if (!$categoria->es_predefinida && $categoria->usuario_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Ups, parece que no tienes permiso para ver esto'], 403);
        }

        $contactos = $categoria->contactos()
            ->where('usuario_id', Auth::id())
            ->get(['id', 'nombres', 'apellidos', 'email', 'foto_path']);

        // Mapear para que coincida con el JS del frontend (que espera 'nombre')
        $contactosFormatted = $contactos->map(function($contacto) {
            return [
                'id' => $contacto->id,
                'nombre' => $contacto->nombres . ' ' . $contacto->apellidos,
                'email' => $contacto->email,
                'foto_path' => $contacto->foto_path ? asset('storage/' . $contacto->foto_path) : null
            ];
        });

        return response()->json([
            'success' => true,
            'total' => $contactosFormatted->count(),
            'contactos' => $contactosFormatted
        ]);
    }
}