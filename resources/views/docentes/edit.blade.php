@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Editar Docente</h1>
        <form action="{{ route('docentes.update', $docente->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ old('nombre', $docente->nombre) }}" required>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="text" name="identificacion" id="identificacion" class="form-control"
                    value="{{ old('identificacion', $docente->identificacion) }}" required>
                @error('identificacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control"
                    value="{{ old('correo', $docente->correo) }}" required>
                @error('correo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="{{ old('direccion', $docente->direccion) }}">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control"
                    value="{{ old('telefono', $docente->telefono) }}">
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <select name="genero" id="genero" class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="Masculino" {{ old('genero', $docente->genero) == 'Masculino' ? 'selected' : '' }}>
                        Masculino</option>
                    <option value="Femenino" {{ old('genero', $docente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino
                    </option>
                    <option value="Otro" {{ old('genero', $docente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                    value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento) }}">
            </div>
            <div class="form-group">
                <label for="formacion_academica">Formación Académica:</label>
                <input type="text" name="formacion_academica" id="formacion_academica" class="form-control"
                    value="{{ old('formacion_academica', $docente->formacion_academica) }}">
            </div>
            <div class="form-group">
                <label for="areas_conocimiento">Áreas de Conocimiento:</label>
                <input type="text" name="areas_conocimiento" id="areas_conocimiento" class="form-control"
                    value="{{ old('areas_conocimiento', $docente->areas_conocimiento) }}">
            </div>
            <div class="form-group">
                <label for="programa_id">Programa:</label>
                <select name="programa_id" id="programa_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->id }}"
                            {{ old('programa_id', $docente->programa_id) == $programa->id ? 'selected' : '' }}>
                            {{ $programa->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="acuerdo_nombramiento">Acuerdo de Nombramiento (opcional):</label>
                <input type="file" name="acuerdo_nombramiento" id="acuerdo_nombramiento" class="form-control">
                @error('acuerdo_nombramiento')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($docente->acuerdo_nombramiento)
                    <p>Archivo actual: <a href="{{ asset('acuerdos/' . $docente->acuerdo_nombramiento) }}"
                            target="_blank">{{ $docente->acuerdo_nombramiento }}</a></p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Docente</button>
            <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
@endsection
