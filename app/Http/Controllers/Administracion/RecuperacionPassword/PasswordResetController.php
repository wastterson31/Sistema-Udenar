<?php

namespace App\Http\Controllers\Administracion\RecuperacionPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No existe un usuario registrado con ese correo.']);
        }

        // Generar nueva contraseña
        $newPassword = Str::random(8);

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($newPassword);
        $user->save();

        // Enviar correo con la nueva contraseña
        $subject = 'Recuperación de contraseña';
        $message = "
            <h2>{$subject}</h2>
            <p>Hola {$user->name},</p>
            <p>Tu nueva contraseña es: <strong>{$newPassword}</strong></p>
            <p>Recuerda cambiarla después de iniciar sesión.</p>
        ";

        Mail::html($message, function ($message) use ($user, $subject) {
            $message->to($user->email)
                ->subject($subject);
        });

        return redirect()->route('login')->with('success', 'Se ha enviado un correo con la nueva contraseña.');
    }
}
