@extends('administrador.index')

@section('content')
    <h1>Editar Presidente: {{ $presidente->nombre }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('presidentes.update', $presidente) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $presidente->nombre) }}" required>
        </div>
        <div class="form-group">
            <label for="identificacion">Identificación:</label>
            <input type="text" name="identificacion" class="form-control"
                value="{{ old('identificacion', $presidente->identificacion) }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $presidente->correo) }}"
                required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $presidente->telefono) }}"
                required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" class="form-control"
                value="{{ old('direccion', $presidente->direccion) }}" required>
        </div>
        <div class="form-group">
            <label for="genero">Género:</label>
            <select name="genero" class="form-control" required>
                <option value="masculino" {{ old('genero', $presidente->genero) == 'masculino' ? 'selected' : '' }}>
                    Masculino</option>
                <option value="femenino" {{ old('genero', $presidente->genero) == 'femenino' ? 'selected' : '' }}>Femenino
                </option>
                <option value="otro" {{ old('genero', $presidente->genero) == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="form-control"
                value="{{ old('fecha_nacimiento', $presidente->fecha_nacimiento) }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_vinculacion">Fecha de Vinculación:</label>
            <input type="date" name="fecha_vinculacion" class="form-control"
                value="{{ old('fecha_vinculacion', $presidente->fecha_vinculacion) }}" required>
        </div>
        <div class="form-group">
            <label for="acuerdo_nombramiento">Acuerdo de Nombramiento (PDF/DOC):</label>
            <input type="file" name="acuerdo_nombramiento" class="form-control" accept=".pdf,.doc,.docx">
            @if ($presidente->acuerdo_nombramiento)
                <p>Archivo actual: <a href="{{ asset('acuerdos/' . $presidente->acuerdo_nombramiento) }}"
                        target="_blank">{{ $presidente->acuerdo_nombramiento }}</a></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Presidente</button>
    </form>
@endsection
