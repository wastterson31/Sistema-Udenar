<?php

namespace App\Http\Controllers\Administracion\Coordinadores;

use App\Http\Controllers\Controller;
use App\Models\Coordinador;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function index()
    {
        $coordinadores = Coordinador::all();
        return view('coordinadores.index', compact('coordinadores'));
    }

    public function create()
    {
        return view('coordinadores.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:coordinadores',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:coordinadores',
            'genero' => 'required|in:Masculino,Femenino,Otro',
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


        Coordinador::create(array_merge($request->all(), ['acuerdo_nombramiento' => $fileName]));

        return redirect()->route('coordinadores.index')->with('success', 'Coordinador creado exitosamente.');
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
            'nombre' => 'required|string|max:255',
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
