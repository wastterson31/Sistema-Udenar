@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Crear Asistente</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('asistentes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="number" name="identificacion" id="identificacion" class="form-control"
                    value="{{ old('identificacion') }}" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="genero">Género</label>
                <select name="genero" id="genero" class="form-control @error('genero') is-invalid @enderror">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('genero')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                    value="{{ old('fecha_nacimiento') }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_vinculacion">Fecha de Vinculación:</label>
                <input type="date" name="fecha_vinculacion" id="fecha_vinculacion" class="form-control"
                    value="{{ old('fecha_vinculacion') }}" required>
            </div>

            <div class="form-group">
                <label for="coordinador_id">Coordinador</label>
                <select name="coordinador_id" id="coordinador_id"
                    class="form-control @error('coordinador_id') is-invalid @enderror">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($coordinadores as $coordinador)
                        <option value="{{ $coordinador->id }}"
                            {{ old('coordinador_id') == $coordinador->id ? 'selected' : '' }}>
                            {{ $coordinador->nombre }}</option>
                    @endforeach
                </select>
                @error('coordinador_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crear Asistente</button>
            <a href="{{ route('asistentes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
@endsection
