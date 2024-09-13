@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Crear Cohorte</h1>

        <form action="{{ route('cohortes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}" required>
                @error('codigo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}"
                    required>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                    value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_finalizacion">Fecha de Finalización:</label>
                <input type="date" name="fecha_finalizacion" id="fecha_finalizacion" class="form-control"
                    value="{{ old('fecha_finalizacion') }}">
                @error('fecha_finalizacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="numero_estudiantes">Número de Estudiantes:</label>
                <input type="number" name="numero_estudiantes" id="numero_estudiantes" class="form-control"
                    value="{{ old('numero_estudiantes') }}" required>
                @error('numero_estudiantes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="programa_id">Programa:</label>
                <select name="programa_id" id="programa_id" class="form-control" required>
                    <!-- Asegúrate de que `programas` esté disponible en la vista -->
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->id }}" {{ old('programa_id') == $programa->id ? 'selected' : '' }}>
                            {{ $programa->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('programa_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear Cohorte</button>
            <a href="{{ route('cohortes.index') }}" class="btn btn-secondary mt-2">Volver a la lista</a>
        </form>
    </div>
@endsection
