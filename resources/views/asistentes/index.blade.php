@extends('administrador.index')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
    <div class="container">
        <h1>Listado de Asistente</h1>
        <a href="{{ route('asistentes.create') }}" class="btn btn-primary mb-2">Crear Asistente</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asistentes as $asistente)
                    <tr>
                        <td>{{ $asistente->id }}</td>
                        <td>{{ $asistente->nombre }}</td>
                        <td>{{ $asistente->identificacion }}</td>
                        <td>{{ $asistente->telefono }}</td>
                        <td>{{ $asistente->correo }}</td>
                        <td>
                            <a href="{{ route('asistentes.show', $asistente->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('asistentes.edit', $asistente->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('asistentes.destroy', $asistente->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este programa?');">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
