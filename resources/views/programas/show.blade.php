@extends('administrador.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalles del Programa</h1>

        <div class="card">
            <div class="card-header">
                Programa ID: {{ $programa->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Código SNIES: {{ $programa->codigo_snies }}</h5>
                <p class="card-text">Nombre: {{ $programa->nombre }}</p>
                <p class="card-text">Descripción: {{ $programa->descripcion }}</p>
                <p class="card-text">Correo: {{ $programa->correo }}</p>
                <p class="card-text">Líneas de Trabajo: {{ $programa->lineas_trabajo }}</p>
                <p class="card-text">Número de Resolución: {{ $programa->numero_resolucion }}</p>
                <p class="card-text">Fecha de Resolución: {{ $programa->fecha_resolucion }}</p>

                @if ($programa->logo)
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <img src="{{ asset($programa->logo) }}" alt="Logo" style="max-height: 150px;">
                    </div>
                @endif

                @if ($programa->archivo_resolucion)
                    <div class="mb-3">
                        <label class="form-label">Archivo de Resolución</label>
                        <a href="{{ asset($programa->archivo_resolucion) }}" target="_blank">Ver Archivo</a>
                    </div>
                @endif

                <a href="{{ route('programas.edit', $programa->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
@endsection
