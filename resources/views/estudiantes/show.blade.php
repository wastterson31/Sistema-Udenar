@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles del Estudiante</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($estudiante->fotografia)
                            <img src="{{ asset($estudiante->fotografia) }}" alt="Fotografía" class="img-thumbnail"
                                width="200">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $estudiante->nombre }}</h3>
                        <p><strong>Identificación:</strong> {{ $estudiante->identificacion }}</p>
                        <p><strong>Código Estudiantil:</strong> {{ $estudiante->codigo_estudiantil }}</p>
                        <p><strong>Dirección:</strong> {{ $estudiante->direccion }}</p>
                        <p><strong>Teléfono:</strong> {{ $estudiante->telefono }}</p>
                        <p><strong>Correo:</strong> {{ $estudiante->correo }}</p>
                        <p><strong>Género:</strong> {{ ucfirst($estudiante->genero) }}</p>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $estudiante->fecha_nacimiento }}</p>
                        <p><strong>Semestre:</strong> {{ $estudiante->semestre }}</p>
                        <p><strong>Estado Civil:</strong> {{ $estudiante->estado_civil }}</p>
                        <p><strong>Fecha de Ingreso:</strong> {{ $estudiante->fecha_ingreso }}</p>
                        <p><strong>Fecha de Egreso:</strong> {{ $estudiante->fecha_egreso }}</p>
                        <p><strong>Cohorte:</strong> {{ $estudiante->cohorte->nombre }}</p>
                        <p><strong>Programa:</strong> {{ $estudiante->programa->nombre }}</p>
                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection