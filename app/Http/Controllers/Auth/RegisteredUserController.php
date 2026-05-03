<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)
                            ->letters()
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                            ->uncompromised()],
            'pregunta_secreta' => ['required', 'string', 'max:255'],
            'pregunta_personalizada' => ['required_if:pregunta_secreta,personalizado', 'nullable', 'string', 'max:255'],
            'respuesta_secreta' => ['required', 'string', 'max:255'],
        ]);

        $rol = \Illuminate\Support\Facades\DB::table('roles')->where('nombre', 'Usuario estándar')->first();
        $rol_id = $rol ? $rol->id : 2;

        $preguntaRaw = $request->pregunta_secreta === 'personalizado' 
            ? $request->pregunta_personalizada 
            : $request->pregunta_secreta;
        
        $pregunta = strtolower($preguntaRaw);
        $respuesta = strtolower($request->respuesta_secreta);

        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pregunta_secreta' => Crypt::encryptString($pregunta),
            'respuesta_secreta' => Hash::make($respuesta),
            'rol_id' => $rol_id,
            'estado' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
