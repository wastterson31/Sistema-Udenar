<?php

namespace App\Http\Controllers\Administracion\Asistentes;

use App\Models\User;
use App\Models\Programa;
use App\Models\Coordinador;
use App\Models\Asistente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AsistenteController extends Controller
{
    public function index()
    {
        $asistentes = Asistente::all();
        return view('asistentes.index', compact('asistentes'));
    }

    public function create()
    {
        $coordinadores = Coordinador::all();
        return view('asistentes.create', compact('coordinadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:asistentes',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:asistentes',
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'coordinador_id' => 'nullable|exists:coordinadores,id'
        ]);



        if ($request->hasFile('acuerdo_nombramiento')) {
            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = null;
        }

        $asistente = Asistente::create(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));
        //return $request;

        if (User::where('email', $asistente->correo)->exists()) {
            return redirect()->route('asistentes.create')->withErrors(['correo' => 'El correo electrónico ya está en uso.']);
        }

        $password = Str::random(8);

        User::create([
            'name' => $asistente->nombre,
            'cedula' => $asistente->identificacion,
            'email' => $asistente->correo,
            'password' => $password,
            'role' => 'asistente',
        ]);

        $subject = 'Credenciales de acceso de Asistente';
        $message = "
            <h2>{$subject}</h2>
            <p>Hola {asistente->nombre},</p>
            <p>Tu cuenta de asistente ha sido creada con éxito. Aquí están tus credenciales:</p>
            <ul>
                <li><strong>Correo:</strong> {$asistente->correo}</li>
                <li><strong>Contraseña:</strong> {$password}</li>
            </ul>
            <p>Recuerda cambiar tu contraseña después de iniciar sesión.</p>
        ";

        Mail::html($message, function ($message) use ($asistente, $subject) {
            $message->to($asistente->correo)
                ->subject($subject);
        });



        return redirect()->route('asistentes.index')->with('success', 'asistente creado exitosamente y contraseña enviada por correo.');


    }



    public function show(Asistente $asistente)
    {
        return view('asistentes.show', compact('asistente'));
    }

    public function edit(Asistente $asistente)
    {
         $coordinadores = Coordinador::all();
        return view('asistentes.edit', compact('asistente','coordinadores'));
    }

    public function update(Request $request, Asistente $asistente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:asistentes,identificacion,' . $asistente->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:asistentes,correo,' . $asistente->id,
            'genero' => 'required|in:masculino,femenino,otro',            
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'coordinador_id' => 'nullable|exists:coordinadores,id'
        ]);

        if ($request->hasFile('acuerdo_nombramiento')) {
            if ($asistente->acuerdo_nombramiento && file_exists(public_path('acuerdos/' . $asistente->acuerdo_nombramiento))) {
                unlink(public_path('acuerdos/' . $asistente->acuerdo_nombramiento));
            }

            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = $asistente->acuerdo_nombramiento;
        }

        $asistente->update(array_merge($request->except('acuerdo_nombramiento'), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('asistentes.index')->with('success', 'Asistente actualizado exitosamente.');
    }

    public function destroy(Asistente $asistente)
    {
        $asistente->delete();

        return redirect()->route('asistentes.index')->with('success', 'Asistente eliminado exitosamente.');
    }
}