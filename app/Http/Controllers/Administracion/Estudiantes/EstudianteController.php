<?php

namespace App\Http\Controllers\Administracion\Estudiantes;

use App\Models\Cohorte;
use App\Models\Programa;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $cohortes = Cohorte::all();
        $programas = Programa::all();
        return view('estudiantes.create', compact('cohortes', 'programas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:estudiantes',
            'codigo_estudiantil' => 'required|string|max:20|unique:estudiantes',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|max:255|unique:estudiantes',
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'nullable|date',
            'semestre' => 'nullable|integer|min:1',
            'estado_civil' => 'nullable|string|max:50',
            'fecha_ingreso' => 'nullable|date',
            'fecha_egreso' => 'nullable|date|after_or_equal:fecha_ingreso',
            'cohorte_id' => 'nullable|exists:cohortes,id',
            'programa_id' => 'nullable|exists:programas,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('fotografia')) {
            $file = $request->file('fotografia');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('estudiantes/fotografias'), $fileName);
            $data['fotografia'] = 'estudiantes/fotografias/' . $fileName;
        }

        Estudiante::create($data);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente.');
    }

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $cohortes = Cohorte::all();
        $programas = Programa::all();
        return view('estudiantes.edit', compact('estudiante', 'cohortes', 'programas'));
    }


    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:estudiantes,identificacion,' . $estudiante->id,
            'codigo_estudiantil' => 'required|string|max:20|unique:estudiantes,codigo_estudiantil,' . $estudiante->id,
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|max:255|unique:estudiantes,correo,' . $estudiante->id,
            'genero' => 'required|in:masculino,femenino,otro',
            'fecha_nacimiento' => 'nullable|date',
            'semestre' => 'nullable|integer|min:1',
            'estado_civil' => 'nullable|string|max:50',
            'fecha_ingreso' => 'nullable|date',
            'fecha_egreso' => 'nullable|date|after_or_equal:fecha_ingreso',
            'cohorte_id' => 'nullable|exists:cohortes,id',
            'programa_id' => 'nullable|exists:programas,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('fotografia')) {

            if ($estudiante->fotografia && file_exists(public_path($estudiante->fotografia))) {
                unlink(public_path($estudiante->fotografia));
            }

            $file = $request->file('fotografia');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('estudiantes/fotografias'), $fileName);
            $data['fotografia'] = 'estudiantes/fotografias/' . $fileName;
        }

        $estudiante->update($data);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente.');
    }


    public function destroy(Estudiante $estudiante)
    {
        if ($estudiante->fotografia && file_exists(public_path($estudiante->fotografia))) {
            unlink(public_path($estudiante->fotografia));
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}
