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
        <h1>Listado de Coordinadores</h1>

        @if (Auth::user()->role === 'presidente')
            <a href="{{ route('coordinadores.create') }}" class="btn btn-primary mb-2">Crear Coordinador</a>
        @endif

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
                @foreach ($coordinadores as $coordinador)
                    <tr>
                        <td>{{ $coordinador->id }}</td>
                        <td>{{ $coordinador->nombre }}</td>
                        <td>{{ $coordinador->identificacion }}</td>
                        <td>{{ $coordinador->telefono }}</td>
                        <td>{{ $coordinador->correo }}</td>
                        <td>
                            <a href="{{ route('coordinadores.show', $coordinador->id) }}" class="btn btn-info">Ver</a>
                            @if (Auth::user()->role === 'presidente')
                                <a href="{{ route('coordinadores.edit', $coordinador->id) }}"
                                    class="btn btn-warning">Editar</a>
                                <form action="{{ route('coordinadores.destroy', $coordinador->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este coordinador?')">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
