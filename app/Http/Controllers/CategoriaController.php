<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('usuario_id', auth()->id())->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only('nombre', 'color');
        $data['usuario_id'] = auth()->id();

        if ($request->hasFile('icono')) {
            $path = $request->file('icono')->store('categorias', 'public');
            $data['icono'] = $path;
        } else {
            $data['icono'] = 'default.svg'; // Or whatever default is preferred
        }

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function update(Request $request, Categoria $categoria)
    {
        if ($categoria->usuario_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only('nombre', 'color');

        if ($request->hasFile('icono')) {
            // Delete old image if it exists and is not a default
            if ($categoria->icono && !str_starts_with($categoria->icono, 'default') && Storage::disk('public')->exists($categoria->icono)) {
                Storage::disk('public')->delete($categoria->icono);
            }
            $path = $request->file('icono')->store('categorias', 'public');
            $data['icono'] = $path;
        }

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->usuario_id !== auth()->id()) {
            abort(403);
        }

        if ($categoria->icono && !str_starts_with($categoria->icono, 'default') && Storage::disk('public')->exists($categoria->icono)) {
            Storage::disk('public')->delete($categoria->icono);
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
