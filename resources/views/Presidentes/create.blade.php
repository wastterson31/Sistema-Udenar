@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Crear Presidente</h1>

        {{-- Mostrar mensajes de error si el correo no cumple con la terminación --}}
        @if ($errors->has('correo'))
            <div class="alert alert-danger">
                {{ $errors->first('correo') }}
            </div>
        @endif

        <form action="{{ route('presidentes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"
                    value="{{ old('identificacion') }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-control" id="genero" name="genero" required>
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}" required>
            </div>
            <div class="mb-3">
                <label for="fecha_vinculacion" class="form-label">Fecha de Vinculación</label>
                <input type="date" class="form-control" id="fecha_vinculacion" name="fecha_vinculacion"
                    value="{{ old('fecha_vinculacion') }}" required>
            </div>
            <div class="mb-3">
                <label for="acuerdo_nombramiento" class="form-label">Acuerdo de Nombramiento</label>
                <input type="file" class="form-control" id="acuerdo_nombramiento" name="acuerdo_nombramiento"
                    accept=".pdf,.doc,.docx">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('presidentes.index') }}" class="btn btn-secondary mt-2">Volver a la lista</a>
        </form>
    </div>
@endsection
