@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Detalles de la Cohorte</h1>

        <div class="card">
            <div class="card-header">
                <h2>{{ $cohorte->nombre }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Código:</strong> {{ $cohorte->codigo }}</p>
                <p><strong>Fecha de Inicio:</strong> {{ $cohorte->fecha_inicio }}</p>
                <p><strong>Fecha de Finalización:</strong>
                    {{ $cohorte->fecha_finalizacion ? $cohorte->fecha_finalizacion : 'N/A' }}</p>
                <p><strong>Número de Estudiantes:</strong> {{ $cohorte->numero_estudiantes }}</p>
                <p><strong>Programa:</strong> {{ $cohorte->programa->nombre }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('cohortes.index') }}" class="btn btn-primary">Volver al Listado</a>
                <a href="{{ route('cohortes.edit', $cohorte->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('cohortes.destroy', $cohorte->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de eliminar esta cohorte?')">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
