@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Editar Coordinador</h1>

        <form action="{{ route('coordinadores.update', $coordinador) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $coordinador->nombre }}"
                    required>
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="text" name="identificacion" id="identificacion" class="form-control"
                    value="{{ $coordinador->identificacion }}" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="{{ $coordinador->direccion }}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control"
                    value="{{ $coordinador->telefono }}" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ $coordinador->correo }}"
                    required>
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <select name="genero" id="genero" class="form-control" required>
                    <option value="masculino" {{ $coordinador->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ $coordinador->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                    value="{{ $coordinador->fecha_nacimiento }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_vinculacion">Fecha de Vinculación:</label>
                <input type="date" name="fecha_vinculacion" id="fecha_vinculacion" class="form-control"
                    value="{{ $coordinador->fecha_vinculacion }}" required>
            </div>
            <div class="form-group">
                <label for="acuerdo_nombramiento">Acuerdo de Nombramiento (Archivo adjunto):</label>
                <input type="file" name="acuerdo_nombramiento" id="acuerdo_nombramiento" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Coordinador</button>
            <a href="{{ route('coordinadores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
@endsection
