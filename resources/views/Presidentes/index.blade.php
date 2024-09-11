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
        <h1>Listado de Presidentes</h1>
        <a href="{{ route('presidentes.create') }}" class="btn btn-primary mb-2">Crear Presidente</a>
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
                @foreach ($presidentes as $presidente)
                    <tr>
                        <td>{{ $presidente->id }}</td>
                        <td>{{ $presidente->nombre }}</td>
                        <td>{{ $presidente->identificacion }}</td>
                        <td>{{ $presidente->telefono }}</td>
                        <td>{{ $presidente->correo }}</td>
                        <td>
                            <a href="{{ route('presidentes.show', $presidente->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('presidentes.edit', $presidente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('presidentes.destroy', $presidente->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este presidente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
