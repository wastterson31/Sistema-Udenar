@extends('layouts.app')

@section('content')
    <h1>Crear Presidente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('presidentes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>
        <div class="form-group">
            <label for="identificacion">Identificación:</label>
            <input type="text" name="identificacion" class="form-control" value="{{ old('identificacion') }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>
        <div class="form-group">
            <label for="genero">Género:</label>
            <select name="genero" class="form-control" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}"
                required>
        </div>
        <div class="form-group">
            <label for="fecha_vinculacion">Fecha de Vinculación:</label>
            <input type="date" name="fecha_vinculacion" class="form-control" value="{{ old('fecha_vinculacion') }}"
                required>
        </div>
        <div class="form-group">
            <label for="acuerdo_nombramiento">Acuerdo de Nombramiento (PDF/DOC):</label>
            <input type="file" name="acuerdo_nombramiento" class="form-control" accept=".pdf,.doc,.docx">
        </div>
        <button type="submit" class="btn btn-success">Crear Presidente</button>
    </form>
@endsection
