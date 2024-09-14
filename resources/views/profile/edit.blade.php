@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Editar Perfil</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula"
                    value="{{ old('cedula', $user->cedula) }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="presidente" {{ old('role', $user->role) == 'presidente' ? 'selected' : '' }}>Presidente
                    </option>
                    <option value="coordinador" {{ old('role', $user->role) == 'coordinador' ? 'selected' : '' }}>
                        Coordinador</option>
                    <option value="asistente" {{ old('role', $user->role) == 'asistente' ? 'selected' : '' }}>Asistente
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

        </form>
    </div>
@endsection
