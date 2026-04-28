<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function showQuestionForm(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:usuarios,email']);

        $user = User::where('email', $request->email)->first();
        
        try {
            $pregunta = Crypt::decrypt($user->pregunta_secreta);
        } catch (\Exception $e) {
            $pregunta = $user->pregunta_secreta; // Por si no está encriptada aún
        }

        return view('auth.reset-password-question', [
            'email' => $user->email,
            'pregunta' => $pregunta
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
            'respuesta' => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();

        try {
            $respuestaCorrecta = Crypt::decrypt($user->respuesta_secreta);
        } catch (\Exception $e) {
            $respuestaCorrecta = $user->respuesta_secreta;
        }

        if (trim(strtolower($request->respuesta)) !== trim(strtolower($respuestaCorrecta))) {
            return back()->withErrors(['respuesta' => 'La respuesta a la pregunta secreta es incorrecta.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida con éxito.');
    }
}
