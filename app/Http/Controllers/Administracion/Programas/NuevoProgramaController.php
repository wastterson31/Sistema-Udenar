<?php

namespace App\Http\Controllers\Administracion\Programas;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use Illuminate\Http\Request;

class NuevoProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::all();
        return view('programas.index', compact('programas'));
    }

    public function create()
    {
        return view('programas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_snies' => 'required|unique:programas|max:255',
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'correo' => 'required|email|unique:programas|max:255',
            'lineas_trabajo' => 'nullable|max:500',
            'numero_resolucion' => 'nullable|numeric',
            'fecha_resolucion' => 'nullable|date',
            'archivo_resolucion' => 'nullable|mimes:pdf|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('programas/logo'), $fileName);
            $logoPath = 'programas/logo/' . $fileName;
        }

        $archivoResolucionPath = null;
        if ($request->hasFile('archivo_resolucion')) {
            $file = $request->file('archivo_resolucion');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('programas/resoluciones'), $fileName);
            $archivoResolucionPath = 'programas/resoluciones/' . $fileName;
        }

        Programa::create([
            'codigo_snies' => $request->input('codigo_snies'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'logo' => $logoPath,
            'correo' => $request->input('correo'),
            'lineas_trabajo' => $request->input('lineas_trabajo'),
            'numero_resolucion' => $request->input('numero_resolucion'),
            'fecha_resolucion' => $request->input('fecha_resolucion'),
            'archivo_resolucion' => $archivoResolucionPath,
        ]);

        return redirect()->route('programas.index')->with('success', 'Programa creado exitosamente.');
    }

    public function show(Programa $programa)
    {
        return view('programas.show', compact('programa'));
    }

    public function edit(Programa $programa)
    {
        return view('programas.edit', compact('programa'));
    }

    public function update(Request $request, Programa $programa)
    {
        $request->validate([
            'codigo_snies' => 'required|unique:programas,codigo_snies,' . $programa->id . '|max:255',
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'correo' => 'required|email|unique:programas,correo,' . $programa->id . '|max:255',
            'lineas_trabajo' => 'nullable|max:500',
            'numero_resolucion' => 'nullable|numeric',
            'fecha_resolucion' => 'nullable|date',
            'archivo_resolucion' => 'nullable|mimes:pdf|max:2048'
        ]);

        $logoPath = $programa->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath && file_exists(public_path($logoPath))) {
                unlink(public_path($logoPath));
            }

            $file = $request->file('logo');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('programas/logo'), $fileName);
            $logoPath = 'programas/logo/' . $fileName;
        }

        $archivoResolucionPath = $programa->archivo_resolucion;
        if ($request->hasFile('archivo_resolucion')) {
            if ($archivoResolucionPath && file_exists(public_path($archivoResolucionPath))) {
                unlink(public_path($archivoResolucionPath));
            }

            $file = $request->file('archivo_resolucion');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('programas/resoluciones'), $fileName);
            $archivoResolucionPath = 'programas/resoluciones/' . $fileName;
        }

        $programa->update([
            'codigo_snies' => $request->input('codigo_snies'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'logo' => $logoPath,
            'correo' => $request->input('correo'),
            'lineas_trabajo' => $request->input('lineas_trabajo'),
            'numero_resolucion' => $request->input('numero_resolucion'),
            'fecha_resolucion' => $request->input('fecha_resolucion'),
            'archivo_resolucion' => $archivoResolucionPath,
        ]);

        return redirect()->route('programas.index')->with('success', 'Programa actualizado exitosamente.');
    }

    public function destroy(Programa $programa)
    {
        if ($programa->logo && file_exists(public_path($programa->logo))) {
            unlink(public_path($programa->logo));
        }
        if ($programa->archivo_resolucion && file_exists(public_path($programa->archivo_resolucion))) {
            unlink(public_path($programa->archivo_resolucion));
        }

        $programa->delete();

        return redirect()->route('programas.index')->with('success', 'Programa eliminado exitosamente.');
    }
}
