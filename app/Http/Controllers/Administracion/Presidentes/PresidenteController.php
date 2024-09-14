<?php

namespace App\Http\Controllers\Administracion\Presidentes;

use App\Models\User;
use App\Models\Presidente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PresidenteController extends Controller
{
    public function index()
    {
        $presidentes = Presidente::all();
        return view('presidentes.index', compact('presidentes'));
    }

    public function create()
    {
        return view('presidentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:presidentes',
            'identificacion' => 'required|string|max:50|unique:presidentes',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:presidentes',
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_nombramiento' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $correo = $request->input('correo');
        if (!Str::endsWith($correo, '@udenar.edu.co')) {
            return redirect()->route('presidentes.create')->withErrors(['correo' => 'El correo electrónico debe tener la terminación @udenar.edu.co']);
        }

        if ($request->hasFile('acuerdo_nombramiento')) {
            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = null;
        }

        $presidente = Presidente::create(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));

        if (User::where('email', $presidente->correo)->exists()) {
            return redirect()->route('presidentes.create')->withErrors(['correo' => 'El correo electrónico ya está en uso.']);
        }

        $password = Str::random(8);

        User::create([
            'name' => $presidente->nombre,
            'cedula' => $presidente->identificacion,
            'email' => $presidente->correo,
            'password' => bcrypt($password),
            'role' => 'presidente',
        ]);

        $subject = 'Credenciales de acceso de Presidente';
        $message = "
            <h2>{$subject}</h2>
            <p>Hola {$presidente->nombre},</p>
            <p>Tu cuenta de presidente ha sido creada con éxito. Aquí están tus credenciales:</p>
            <ul>
                <li><strong>Correo:</strong> {$presidente->correo}</li>
                <li><strong>Contraseña:</strong> {$password}</li>
            </ul>
            <p>Recuerda cambiar tu contraseña después de iniciar sesión.</p>
        ";

        Mail::html($message, function ($message) use ($presidente, $subject) {
            $message->to($presidente->correo)
                ->subject($subject);
        });

        return redirect()->route('presidentes.index')->with('success', 'Presidente creado exitosamente y contraseña enviada por correo.');
    }

    public function show(Presidente $presidente)
    {
        return view('presidentes.show', compact('presidente'));
    }

    public function edit(Presidente $presidente)
    {
        return view('presidentes.edit', compact('presidente'));
    }

    public function update(Request $request, Presidente $presidente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:presidentes,nombre,' . $presidente->id,
            'identificacion' => 'required|string|max:50|unique:presidentes,identificacion,' . $presidente->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:presidentes,correo,' . $presidente->id,
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_nombramiento' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $correo = $request->input('correo');
        if (!Str::endsWith($correo, '@udenar.edu.co')) {
            return redirect()->route('presidentes.edit', $presidente)->withErrors(['correo' => 'El correo electrónico debe tener la terminación @udenar.edu.co.']);
        }

        if ($request->hasFile('acuerdo_nombramiento')) {
            if ($presidente->acuerdo_nombramiento && file_exists(public_path('acuerdos/' . $presidente->acuerdo_nombramiento))) {
                unlink(public_path('acuerdos/' . $presidente->acuerdo_nombramiento));
            }

            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = $presidente->acuerdo_nombramiento;
        }

        $presidente->update(array_merge($request->except('acuerdo_nombramiento'), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('presidentes.index')->with('success', 'Presidente actualizado exitosamente.');
    }

    public function destroy(Presidente $presidente)
    {
        $presidente->delete();

        return redirect()->route('presidentes.index')->with('success', 'Presidente eliminado exitosamente.');
    }
}
