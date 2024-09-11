@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles del Presidente</h1>
        <p><strong>ID:</strong> {{ $presidente->id }}</p>
        <p><strong>Nombre:</strong> {{ $presidente->nombre }}</p>
        <p><strong>Identificación:</strong> {{ $presidente->identificacion }}</p>
        <p><strong>Teléfono:</strong> {{ $presidente->telefono }}</p>
        <p><strong>Correo:</strong> {{ $presidente->correo }}</p>
        <p><strong>Dirección:</strong> {{ $presidente->direccion }}</p>
        <p><strong>Género:</strong> {{ ucfirst($presidente->genero) }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $presidente->fecha_nacimiento }}</p>
        <p><strong>Fecha de Vinculación:</strong> {{ $presidente->fecha_vinculacion }}</p>
        @if ($presidente->acuerdo_nombramiento)
            <p><strong>Acuerdo de Nombramiento:</strong> <a
                    href="{{ asset('acuerdos/' . $presidente->acuerdo_nombramiento) }}"
                    target="_blank">{{ $presidente->acuerdo_nombramiento }}</a></p>
        @endif
        <a href="{{ route('presidentes.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
