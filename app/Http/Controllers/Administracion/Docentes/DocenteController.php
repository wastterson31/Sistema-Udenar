<?php

namespace App\Http\Controllers\Administracion\Docentes;

use App\Models\Docente;
use App\Models\Programa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $programas = Programa::all();
        return view('docentes.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:docentes',
            'identificacion' => 'required|string|max:20|unique:docentes',
            'correo' => 'required|email|max:255|unique:docentes',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'nullable|date',
            'formacion_academica' => 'nullable|string|max:255',
            'areas_conocimiento' => 'nullable|string|max:255',
            'programa_id' => 'nullable|exists:programas,id',
            'acuerdo_nombramiento' => 'nullable|file|mimes:doc,docx,xls,xlsx',
        ]);

        if ($request->hasFile('acuerdo_nombramiento')) {
            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = null;
        }

        Docente::create(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        $programas = Programa::all();
        return view('docentes.edit', compact('docente', 'programas'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:docentes,identificacion,' . $docente->id,
            'correo' => 'required|email|max:255|unique:docentes,correo,' . $docente->id,
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'nullable|date',
            'formacion_academica' => 'nullable|string|max:255',
            'areas_conocimiento' => 'nullable|string|max:255',
            'programa_id' => 'nullable|exists:programas,id',
            'acuerdo_nombramiento' => 'nullable|file|mimes:doc,docx,xlsx|max:2048',
        ]);

        if ($request->hasFile('acuerdo_nombramiento')) {
            if ($docente->acuerdo_nombramiento && file_exists(public_path('acuerdos/' . $docente->acuerdo_nombramiento))) {
                unlink(public_path('acuerdos/' . $docente->acuerdo_nombramiento));
            }

            $file = $request->file('acuerdo_nombramiento');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('acuerdos'), $fileName);
        } else {
            $fileName = $docente->acuerdo_nombramiento;
        }

        $docente->update(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
