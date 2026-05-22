<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
            'pregunta_secreta' => 'required|string',
            'pregunta_personalizada' => 'required_if:pregunta_secreta,personalizado|nullable|string',
            'respuesta_secreta' => 'required|string',
            'password' => [
                'required', 
                'confirmed', 
                Rules\Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        $key = 'forgot-password-'.$request->ip().'-'.$request->email;

        // Implement rate limiting: 3 attempts, 1 minute lockout
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ['Demasiados intentos fallidos. Por favor, intenta de nuevo en ' . $seconds . ' segundos.'],
            ]);
        }

        $user = User::where('email', $request->email)->first();

        // Check if the provided question matches the encrypted question in DB
        $preguntaRaw = $request->pregunta_secreta === 'personalizado' 
            ? $request->pregunta_personalizada 
            : $request->pregunta_secreta;
        $preguntaInput = strtolower($preguntaRaw);

        try {
            // Crypt::encryptString was used during registration
            $preguntaDB = strtolower(Crypt::decryptString($user->pregunta_secreta));
        } catch (\Exception $e) {
            // Fallback just in case it wasn't encrypted correctly
            $preguntaDB = strtolower($user->pregunta_secreta);
        }

        // Verify question and answer
        $respuestaInput = strtolower($request->respuesta_secreta);
        $respuestaDB = $user->respuesta_secreta;

        $isQuestionValid = trim($preguntaInput) === trim($preguntaDB);
        
        // Use Hash::check because it was hashed with Hash::make in RegisteredUserController
        $isAnswerValid = Hash::check($respuestaInput, $respuestaDB);
        
        if (!$isQuestionValid || !$isAnswerValid) {
            RateLimiter::hit($key, 60); // 1 minute lockout after 3 fails
            
            throw ValidationException::withMessages([
                'respuesta' => ['La pregunta o respuesta secreta proporcionada es incorrecta.']
            ]);
        }

        // Evitar que la nueva contraseña sea la misma que la actual
        if (Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['La nueva contraseña no puede ser igual a tu contraseña actual. Por razones de seguridad, elige una contraseña diferente.']
            ]);
        }

        RateLimiter::clear($key);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida con éxito.');
    }
}
