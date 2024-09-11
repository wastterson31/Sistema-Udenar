<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd($credentials);

        $email = $request->input('email');

        // Verificar que el correo tiene el dominio permitido
        if (!str_ends_with($email, '@udenar.edu.co')) {
            return Redirect::back()->withErrors(['email' => 'El correo debe ser académico con el dominio @udenar.edu.co.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('paginaPrincipal');
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
}
