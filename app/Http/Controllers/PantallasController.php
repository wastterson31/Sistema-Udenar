<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PantallasController extends Controller
{
    public function paginaPrincipal()
    {
        return view('administrador.index');
    }

    public function RecuperacionContraseña()
    {
        return view('login.recuperarlogin');
    }
}
