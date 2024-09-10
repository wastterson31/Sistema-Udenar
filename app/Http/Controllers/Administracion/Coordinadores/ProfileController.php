<?php

namespace App\Http\Controllers\Administracion\Coordinadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // dd($user);
        return view('coordinadores.profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
        } else {
            return redirect()->back()->withErrors('Usuario no encontrado.');
        }
    }
}
