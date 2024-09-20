<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->input('email');


        if (!str_ends_with($email, '@udenar.edu.co')) {
            return Redirect::back()->withErrors(['email' => 'El correo debe ser académico con el dominio @udenar.edu.co.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($request->hasCookie('verification_passed')) {

                return redirect()->route('paginaPrincipal');
            }


            $verificationCode = Str::random(8);

            DB::table('user')
                ->where('id', $user->id)
                ->update(['verification_code' => $verificationCode]);

            $subject = "Código de verificación";
            $message = "
                <h2>{$subject}</h2>
                <p>Hola {$user->name},</p>
                <p>Tu código de verificación es: <strong>{$verificationCode}</strong></p>
                <p>Por favor, ingresa este código para completar el inicio de sesión.</p>
            ";

            Mail::html($message, function ($msg) use ($user, $subject) {
                $msg->to($user->email)
                    ->subject($subject);
            });

            return redirect()->route('verificarCodigo');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function mostrarFormularioVerificacion()
    {
        return view('auth.verificar_codigo');
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string',
        ]);

        $user = Auth::user();


        if ($user->verification_code === $request->input('verification_code')) {

            $minutes = 60 * 24 * 30;
            return redirect()->route('paginaPrincipal')
                ->cookie('verification_passed', 'true', $minutes);
        }

        return back()->withErrors(['verification_code' => 'El código de verificación es incorrecto.']);
    }
}
