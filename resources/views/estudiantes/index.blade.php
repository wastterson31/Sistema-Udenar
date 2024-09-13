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
        <h1>Lista de Estudiantes</h1>
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary mb-3">Agregar Estudiante</a>

        {{-- @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Código Estudiantil</th>
                    <th>Correo</th>
                    <th>Fotografía</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->identificacion }}</td>
                        <td>{{ $estudiante->codigo_estudiantil }}</td>
                        <td>{{ $estudiante->correo }}</td>
                        <td>
                            @if ($estudiante->fotografia)
                                <img src="{{ asset($estudiante->fotografia) }}" alt="Fotografía" class="img-thumbnail"
                                    width="100">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver</a>
                            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>Editar</a>
                            <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este presidente?');">
                                    <i class="fas fa-trash"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
