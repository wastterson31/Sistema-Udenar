@extends('administrador.index')

@section('content')
    <h1>Detalles del Presidente: {{ $presidente->nombre }}</h1>

    <p><strong>Identificación:</strong> {{ $presidente->identificacion }}</p>
    <p><strong>Correo:</strong> {{ $presidente->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $presidente->telefono }}</p>
    <p><strong>Dirección:</strong> {{ $presidente->direccion }}</p>
    <p><strong>Género:</strong> {{ ucfirst($presidente->genero) }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $presidente->fecha_nacimiento->format('d/m/Y') }}</p>
    <p><strong>Fecha de Vinculación:</strong> {{ $presidente->fecha_vinculacion->format('d/m/Y') }}</p>
    <p><strong>Acuerdo de Nombramiento:</strong>
        @if ($presidente->acuerdo_nombramiento)
            <a href="{{ asset('acuerdos/' . $presidente->acuerdo_nombramiento) }}" target="_blank">Ver archivo</a>
        @else
            No hay archivo
        @endif
    </p>

    <a href="{{ route('presidentes.index') }}" class="btn btn-secondary">Volver</a>
@endsection
