@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles del Docente</h1>
        <p><strong>ID:</strong> {{ $docente->id }}</p>
        <p><strong>Nombre:</strong> {{ $docente->nombre }}</p>
        <p><strong>Identificación:</strong> {{ $docente->identificacion }}</p>
        <p><strong>Correo:</strong> {{ $docente->correo }}</p>
        <p><strong>Dirección:</strong> {{ $docente->direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $docente->telefono }}</p>
        <p><strong>Género:</strong> {{ $docente->genero }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $docente->fecha_nacimiento }}</p>
        <p><strong>Formación Académica:</strong> {{ $docente->formacion_academica }}</p>
        <p><strong>Áreas de Conocimiento:</strong> {{ $docente->areas_conocimiento }}</p>
        <p><strong>Programa:</strong> {{ $docente->programa ? $docente->programa->nombre : 'N/A' }}</p>

        <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('docentes.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
@endsection
