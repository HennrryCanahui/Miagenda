<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactosExport;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contacto::where('usuario_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('telefonos', function($subQuery) use ($search) {
                      $subQuery->where('numero', 'like', "%{$search}%");
                  });
            });
        }

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
     * Export contacts to Excel/CSV.
     */
    public function exportCsv(Request $request)
    {
        $contactos = Contacto::where('usuario_id', Auth::id())->with('categoria', 'telefonos')->get();

        return Excel::download(new ContactosExport($contactos), 'contactos_export_' . now()->format('Ymd_His') . '.xlsx');
    }

    /**
     * Export contacts to PDF.
     */
    public function exportPdf(Request $request)
    {
        $contactos = Contacto::where('usuario_id', Auth::id())->with('categoria', 'telefonos')->get();

        $pdf = Pdf::loadView('contacts.pdf', compact('contactos'));
        
        return $pdf->download("contactos_export_" . date('Ymd_His') . ".pdf");
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
            'nombres'      => 'required|string|max:255',
            'apellidos'    => 'required|string|max:255',
            'email'        => 'nullable|email',
            'categoria_id' => 'required|exists:categorias,id',
            'telefono'     => 'nullable|string|max:255',
            'direccion'    => 'nullable|string|max:255',
            'foto'         => 'nullable|image|max:2048',
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
                'numero'      => $request->telefono,
                'tipo'        => 'Principal',
                'codigo_pais' => '+502',
            ]);
        }

        return redirect()->route('contacts.index')->with('success', '¡Genial! El contacto se ha guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403, 'Ups, parece que este contacto no te pertenece o no tienes permiso para verlo.');
        }

        $categorias = Categoria::where(function($q) {
            $q->where('usuario_id', Auth::id())
              ->orWhere('es_predefinida', true);
        })->get();

        return view('contacts.show', compact('contacto', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403, 'Ups, parece que este contacto no te pertenece o no tienes permiso para editarlo.');
        }

        $categorias = Categoria::where(function($q) {
            $q->where('usuario_id', Auth::id())
              ->orWhere('es_predefinida', true);
        })->get();

        return view('contacts.edit', compact('contacto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403, 'Ups, parece que este contacto no te pertenece o no tienes permiso para actualizarlo.');
        }

        $request->validate([
            'nombres'      => 'required|string|max:255',
            'apellidos'    => 'required|string|max:255',
            'email'        => 'nullable|email',
            'categoria_id' => 'required|exists:categorias,id',
            'telefono'     => 'nullable|string|max:255',
            'direccion'    => 'nullable|string|max:255',
            'foto'         => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['telefono']);

        if ($request->hasFile('foto')) {
            if ($contacto->foto_path && Storage::disk('public')->exists($contacto->foto_path)) {
                Storage::disk('public')->delete($contacto->foto_path);
            }

            $data['foto_path'] = $request->file('foto')->store('contactos', 'public');
        }

        $contacto->update($data);

        if ($request->filled('telefono')) {
            $telefono = \App\Models\Telefono::firstOrNew(['contacto_id' => $contacto->id]);
            $telefono->numero      = $request->telefono;
            $telefono->tipo        = 'Principal';
            $telefono->codigo_pais = '+502';
            $telefono->save();
        }

        return redirect()->route('contacts.index')->with('success', '¡Perfecto! Los cambios del contacto se han guardado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contacto $contacto)
    {
        if ($contacto->usuario_id !== Auth::id()) {
            abort(403, 'Ups, parece que este contacto no te pertenece o no tienes permiso para eliminarlo.');
        }

        if ($contacto->foto_path && Storage::disk('public')->exists($contacto->foto_path)) {
            Storage::disk('public')->delete($contacto->foto_path);
        }

        $contacto->delete();

        return redirect()->route('contacts.index')->with('success', 'El contacto ha sido eliminado sin problemas.');
    }
}