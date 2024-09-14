@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Editar Presidente</h1>
        <form action="{{ route('presidentes.update', $presidente->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $presidente->nombre }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"
                    value="{{ $presidente->identificacion }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono"
                    value="{{ $presidente->telefono }}" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ $presidente->correo }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ $presidente->direccion }}" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-control" id="genero" name="genero" required>
                    <option value="masculino" {{ $presidente->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ $presidente->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ $presidente->genero == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                    value="{{ $presidente->fecha_nacimiento }}" required>
            </div>
            <div class="mb-3">
                <label for="fecha_vinculacion" class="form-label">Fecha de Vinculación</label>
                <input type="date" class="form-control" id="fecha_vinculacion" name="fecha_vinculacion"
                    value="{{ $presidente->fecha_vinculacion }}" required>
            </div>
            <div class="mb-3">
                <label for="acuerdo_nombramiento" class="form-label">Acuerdo de Nombramiento</label>
                <input type="file" class="form-control" id="acuerdo_nombramiento" name="acuerdo_nombramiento"
                    accept=".pdf,.doc,.docx">
                @if ($presidente->acuerdo_nombramiento)
                    <p>Archivo actual: <a href="{{ asset('acuerdos/' . $presidente->acuerdo_nombramiento) }}"
                            target="_blank">{{ $presidente->acuerdo_nombramiento }}</a></p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('presidentes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
@endsection
