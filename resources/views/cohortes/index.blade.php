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
        <h1>Listado de Cohortes</h1>

        <a href="{{ route('cohortes.create') }}" class="btn btn-primary mb-3">Crear Nueva Cohorte</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalización</th>
                    <th>Número de Estudiantes</th>
                    <th>Programa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cohortes as $cohorte)
                    <tr>
                        <td>{{ $cohorte->codigo }}</td>
                        <td>{{ $cohorte->nombre }}</td>
                        <td>{{ $cohorte->fecha_inicio }}</td>
                        <td>{{ $cohorte->fecha_finalizacion }}</td>
                        <td>{{ $cohorte->numero_estudiantes }}</td>
                        <td>{{ $cohorte->programa->nombre }}</td>
                        <td>
                            <a href="{{ route('cohortes.show', $cohorte->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver
                                <a href="{{ route('cohortes.edit', $cohorte->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('cohortes.destroy', $cohorte->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este programa?');">
                                        <i class="fas fa-trash"></i> Eliminar</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
