@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles del asistente</h1>

        <div class="card">
            <div class="card-header">
                <h2>{{ $asistente->nombre }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Identificación:</strong> {{ $asistente->identificacion }}</p>
                <p><strong>Dirección:</strong> {{ $asistente->direccion }}</p>
                <p><strong>Teléfono:</strong> {{ $asistente->telefono }}</p>
                <p><strong>Correo:</strong> {{ $asistente->correo }}</p>
                <p><strong>Género:</strong> {{ $asistente->genero }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $asistente->fecha_nacimiento }}</p>
                <p><strong>Fecha de Vinculación:</strong> {{ $asistente->fecha_vinculacion }}</p>
                <p><strong>Coordinador:</strong>
                    {{ $asistente->coordinador ? $asistente->coordinador->nombre : 'No asignado' }}</p>
            </div>
        </div>

        <a href="{{ route('asistentes.index') }}" class="btn btn-secondary mt-3">Volver al Listado</a>
    </div>
@endsection
