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
        <h1 class="mb-4">Lista de Programas</h1>

        <a href="{{ route('programas.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Nuevo Programa
        </a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código SNIES</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programas as $programa)
                    <tr>
                        <td>{{ $programa->id }}</td>
                        <td>{{ $programa->codigo_snies }}</td>
                        <td>{{ $programa->nombre }}</td>
                        <td>{{ $programa->correo }}</td>
                        <td>
                            <a href="{{ route('programas.show', $programa->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('programas.edit', $programa->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('programas.destroy', $programa->id) }}" method="POST"
                                style="display:inline;">
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
