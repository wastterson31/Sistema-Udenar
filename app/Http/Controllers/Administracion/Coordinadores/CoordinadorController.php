<?php

namespace App\Http\Controllers\Administracion\Coordinadores;

use App\Models\User;
use App\Models\Programa;
use App\Models\Asistente;
use App\Models\Coordinador;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CoordinadorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'coordinador') {
            $coordinadores = Coordinador::where('correo', $user->email)->get();
        } elseif ($user->role === 'asistente') {
            $asistente = Asistente::where('correo', $user->email)->first();
            $coordinadores = Coordinador::where('id', $asistente->coordinador_id)->get();
        } else {
            $coordinadores = Coordinador::all();
        }

        return view('coordinadores.index', compact('coordinadores'));
    }



    public function create()
    {
        $programas = Programa::all();
        return view('coordinadores.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:coordinadores',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:coordinadores',
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_nombramiento' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('acuerdo_nombramiento')) {
            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = null;
        }

        $coordinador = Coordinador::create(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));

        if (User::where('email', $coordinador->correo)->exists()) {
            return redirect()->route('coordinadores.create')->withErrors(['correo' => 'El correo electrónico ya está en uso.']);
        }

        $password = Str::random(8);

        User::create([
            'name' => $coordinador->nombre,
            'cedula' => $coordinador->identificacion,
            'email' => $coordinador->correo,
            'password' => bcrypt($password),
            'role' => 'coordinador',
        ]);

        $subject = 'Credenciales de acceso de Coordinador';
        $message = "
            <h2>{$subject}</h2>
            <p>Hola {$coordinador->nombre},</p>
            <p>Tu cuenta de coordinador ha sido creada con éxito. Aquí están tus credenciales:</p>
            <ul>
                <li><strong>Correo:</strong> {$coordinador->correo}</li>
                <li><strong>Contraseña:</strong> {$password}</li>
            </ul>
            <p>Recuerda cambiar tu contraseña después de iniciar sesión.</p>
        ";

        Mail::html($message, function ($message) use ($coordinador, $subject) {
            $message->to($coordinador->correo)
                ->subject($subject);
        });

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador creado exitosamente y contraseña enviada por correo.');
    }



    public function show(Coordinador $coordinador)
    {
        return view('coordinadores.show', compact('coordinador'));
    }

    public function edit(Coordinador $coordinador)
    {
        return view('coordinadores.edit', compact('coordinador'));
    }

    public function update(Request $request, Coordinador $coordinador)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:coordinador',
            'identificacion' => 'required|string|max:50|unique:coordinadores,identificacion,' . $coordinador->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:coordinadores,correo,' . $coordinador->id,
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_nombramiento' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('acuerdo_nombramiento')) {
            if ($coordinador->acuerdo_nombramiento && file_exists(public_path('acuerdos/' . $coordinador->acuerdo_nombramiento))) {
                unlink(public_path('acuerdos/' . $coordinador->acuerdo_nombramiento));
            }

            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = $coordinador->acuerdo_nombramiento;
        }

        $coordinador->update(array_merge($request->except('acuerdo_nombramiento'), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador actualizado exitosamente.');
    }

    public function destroy(Coordinador $coordinador)
    {
        $coordinador->delete();

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador eliminado exitosamente.');
    }
}
