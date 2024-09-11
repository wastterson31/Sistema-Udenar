@extends('administrador.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Programa</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('programas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="codigo_snies" class="form-label">Código SNIES</label>
                <input type="text" class="form-control" id="codigo_snies" name="codigo_snies"
                    value="{{ old('codigo_snies') }}" required>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo (opcional)</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="lineas_trabajo" class="form-label">Líneas de Trabajo</label>
                <textarea class="form-control" id="lineas_trabajo" name="lineas_trabajo">{{ old('lineas_trabajo') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="numero_resolucion" class="form-label">Número de Resolución (opcional)</label>
                <input type="text" class="form-control" id="numero_resolucion" name="numero_resolucion"
                    value="{{ old('numero_resolucion') }}">
            </div>

            <div class="mb-3">
                <label for="fecha_resolucion" class="form-label">Fecha de Resolución (opcional)</label>
                <input type="date" class="form-control" id="fecha_resolucion" name="fecha_resolucion"
                    value="{{ old('fecha_resolucion') }}">
            </div>

            <div class="mb-3">
                <label for="archivo_resolucion" class="form-label">Archivo de Resolución (opcional)</label>
                <input type="file" class="form-control" id="archivo_resolucion" name="archivo_resolucion">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
@endsection
