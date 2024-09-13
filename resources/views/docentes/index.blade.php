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
        <h1>Listado de Docentes</h1>
        <a href="{{ route('docentes.create') }}" class="btn btn-primary mb-2">Crear Docente</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Programa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->id }}</td>
                        <td>{{ $docente->nombre }}</td>
                        <td>{{ $docente->identificacion }}</td>
                        <td>{{ $docente->correo }}</td>
                        <td>{{ $docente->telefono }}</td>
                        <td>{{ $docente->programa ? $docente->programa->nombre : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('docentes.show', $docente->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver</a>
                            <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>Editar</a>
                            <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @if (Auth::user()->role === 'presidente')
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este presidente?');">
                                        <i class="fas fa-trash"></i> Eliminar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
