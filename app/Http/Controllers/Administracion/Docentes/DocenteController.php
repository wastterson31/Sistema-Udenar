<?php

namespace App\Http\Controllers\Administracion\Docentes;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:docentes',
            'correo' => 'required|email|max:255|unique:docentes',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'nullable|date',
            'formacion_academica' => 'nullable|string|max:255',
            'areas_conocimiento' => 'nullable|string|max:255',
        ]);

        Docente::create($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
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
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }
    public function destroy(Docente $docente)
    {
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
