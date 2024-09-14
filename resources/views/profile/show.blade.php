@extends('administrador.index')


@section('content')
    <div class="container">
        <h1>Detalles del Usuario</h1>

        <div class="card">
            <div class="card-header">
                Usuario ID: {{ $user->id }}
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Cédula:</strong> {{ $user->cedula }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
                <p><strong>Rol:</strong> {{ ucfirst($user->role) }}</p>
                <p><strong>Creado en:</strong> {{ $user->created_at }}</p>
                <p><strong>Actualizado en:</strong> {{ $user->updated_at }}</p>

                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-warning">Editar</a>

                <form action="{{ route('profile.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                        Eliminar
                    </button>
                </form>

                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Volver a la lista de</a>
            </div>
        </div>
    </div>
@endsection
