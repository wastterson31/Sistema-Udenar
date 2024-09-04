<?php

namespace App\Http\Controllers\Administracion\Cohortes;

use App\Models\Cohorte;
use App\Models\Programa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CohorteController extends Controller
{
    public function index()
    {
        $cohortes = Cohorte::all();
        return view('cohortes.index', compact('cohortes'));
    }

    public function create()
    {
        $programas = Programa::all();
        return view('cohortes.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:cohortes',
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date|before:fecha_finalizacion',
            'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_inicio',
            'numero_estudiantes' => 'required|integer|min:1',
            'programa_id' => 'required|exists:programas,id',
        ]);

        Cohorte::create($request->all());

        return redirect()->route('cohortes.index')->with('success', 'Cohorte creada exitosamente.');
    }

    public function show(Cohorte $cohorte)
    {
        return view('cohortes.show', compact('cohorte'));
    }

    public function edit(Cohorte $cohorte)
    {
        $programas = Programa::all();
        return view('cohortes.edit', compact('cohorte', 'programas'));
    }


    public function update(Request $request, Cohorte $cohorte)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:cohortes,codigo,' . $cohorte->id,
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date|before:fecha_finalizacion',
            'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_inicio',
            'numero_estudiantes' => 'required|integer|min:1',
            'programa_id' => 'required|exists:programas,id',
        ]);

        $cohorte->update($request->all());

        return redirect()->route('cohortes.index')->with('success', 'Cohorte actualizada exitosamente.');
    }

    public function destroy(Cohorte $cohorte)
    {
        $cohorte->delete();

        return redirect()->route('cohortes.index')->with('success', 'Cohorte eliminada exitosamente.');
    }
}
