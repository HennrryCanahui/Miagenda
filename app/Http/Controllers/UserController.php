<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt; // <-- IMPORTANTE: Importamos el Facade Crypt
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('rol')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
            'rol_id' => 'required|exists:roles,id',
            'estado' => 'required|boolean',
            'pregunta_secreta' => 'nullable|string',
            'respuesta_secreta' => 'nullable|string',
        ]);

        // Encriptamos la pregunta y hasheamos la respuesta si vienen en la petición (como en el registro)
        $preguntaEncriptada = $request->filled('pregunta_secreta') ? Crypt::encryptString(strtolower($request->pregunta_secreta)) : null;
        $respuestaHash = $request->filled('respuesta_secreta') ? Hash::make(strtolower($request->respuesta_secreta)) : null;

        User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'estado' => $request->estado,
            'pregunta_secreta' => $preguntaEncriptada,
            'respuesta_secreta' => $respuestaHash,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Capa de verificación: Solo el propio usuario o un administrador puede editar
        if (!auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            abort(403, 'No tienes permiso para editar este perfil.');
        }

        $roles = Rol::all();

        // Desencriptamos la pregunta
        try {
            if ($user->pregunta_secreta) {
                $decrypted = Crypt::decryptString($user->pregunta_secreta);
                // Comprobamos si la cadena desencriptada está serializada (legacy de Crypt::encrypt)
                $unserialized = @unserialize($decrypted);
                if ($unserialized !== false || $decrypted === 'b:0;') {
                    $user->pregunta_secreta = $unserialized;
                } else {
                    $user->pregunta_secreta = $decrypted;
                }
            }
        } catch (\Exception $e) {
            $user->pregunta_secreta = '';
        }

        // Vaciamos la respuesta para que el input salga limpio (al igual que la contraseña)
        $user->respuesta_secreta = '';

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Capa de verificación: Solo el propio usuario o un administrador puede actualizar
        if (!auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            abort(403, 'No tienes permiso para actualizar este perfil.');
        }

        // Reglas base
        $rules = [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'pregunta_secreta' => 'nullable|string',
            'respuesta_secreta' => 'nullable|string',
        ];

        // Solo el administrador puede modificar el rol y el estado de OTROS usuarios
        if (auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            $rules['rol_id'] = 'required|exists:roles,id';
            $rules['estado'] = 'required|boolean';
        }

        $request->validate($rules);

        // Inicializamos data sin la pregunta ni la respuesta
        $data = [
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
        ];

        // Añadimos pregunta/respuesta solo si el usuario las ha escrito para cambiarlas
        if ($request->filled('pregunta_secreta')) {
            $data['pregunta_secreta'] = Crypt::encryptString(strtolower($request->pregunta_secreta));
        }

        if ($request->filled('respuesta_secreta')) {
            $data['respuesta_secreta'] = Hash::make(strtolower($request->respuesta_secreta));
        }

        if (auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            $data['rol_id'] = $request->rol_id;
            $data['estado'] = $request->estado;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if (auth()->user()->isAdmin()) {
            return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Perfil actualizado exitosamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // En lugar de borrar de la base de datos, simplemente lo desactivamos. 
        $user->update(['estado' => 0]);

        return redirect()->route('users.index')->with('success', 'Usuario desactivado exitosamente.');
    }
}