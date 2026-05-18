<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contacto::where('usuario_id', Auth::id());

        // Filtrar por búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtrar por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $contactos = $query->with('categoria')->paginate(9);
        
        $categorias = Categoria::where(function($q) {
            $q->where('usuario_id', Auth::id())
              ->orWhere('es_predefinida', true);
        })->get();

        return view('contacts.index', compact('contactos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where(function($q) {
            $q->where('usuario_id', Auth::id())
              ->orWhere('es_predefinida', true);
        })->get();

        return view('contacts.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'nullable|email',
            'categoria_id' => 'required|exists:categorias,id',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['telefono']);
        $data['usuario_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('contactos', 'public');
        }

        $contacto = Contacto::create($data);

        if ($request->filled('telefono')) {
            \App\Models\Telefono::create([
                'contacto_id' => $contacto->id,
                'numero' => $request->telefono,
                'tipo' => 'Principal',
                'codigo_pais' => '+502', // Default based on placeholder
            ]);
        }

        return redirect()->route('contacts.index')->with('success', 'Contacto creado con éxito.');
    }
    public function edit(Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403);
        }

        $categorias = Categoria::where(function($q) {
            $q->where('usuario_id', Auth::id())
              ->orWhere('es_predefinida', true);
        })->get();

        return view('contacts.edit', compact('contacto', 'categorias'));
    }

    public function update(Request $request, Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'nullable|email',
            'categoria_id' => 'required|exists:categorias,id',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['telefono']);

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('contactos', 'public');
        }

        $contacto->update($data);

        if ($request->filled('telefono')) {
            $telefono = \App\Models\Telefono::firstOrNew(['contacto_id' => $contacto->id]);
            $telefono->numero = $request->telefono;
            $telefono->tipo = 'Principal';
            $telefono->codigo_pais = '+502';
            $telefono->save();
        }

        return redirect()->route('contacts.index')->with('success', 'Contacto actualizado con éxito.');
    }
}
