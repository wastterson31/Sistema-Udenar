@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles del Coordinador</h1>

        <div class="card">
            <div class="card-header">
                <h2>{{ $coordinador->nombre }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Identificación:</strong> {{ $coordinador->identificacion }}</p>
                <p><strong>Dirección:</strong> {{ $coordinador->direccion }}</p>
                <p><strong>Teléfono:</strong> {{ $coordinador->telefono }}</p>
                <p><strong>Correo:</strong> {{ $coordinador->correo }}</p>
                <p><strong>Género:</strong> {{ $coordinador->genero }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $coordinador->fecha_nacimiento }}</p>
                <p><strong>Fecha de Vinculación:</strong> {{ $coordinador->fecha_vinculacion }}</p>
                <p><strong>Acuerdo de Nombramiento:</strong>
                    @if ($coordinador->acuerdo_nombramiento)
                        <a href="{{ asset('acuerdos/' . $coordinador->acuerdo_nombramiento) }}" target="_blank">Ver
                            Documento</a>
                    @else
                        No hay documento disponible.
                    @endif
                </p>
            </div>
        </div>

        <a href="{{ route('coordinadores.index') }}" class="btn btn-secondary mt-3">Volver al Listado</a>
    </div>
@endsection
