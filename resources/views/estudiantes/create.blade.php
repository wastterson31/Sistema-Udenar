@extends('administrador.index')

@section('content')
    <div class="container">
        <h1>Agregar Estudiante</h1>
        <form action="{{ route('estudiantes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="identificacion">Identificación</label>
                <input type="text" name="identificacion" id="identificacion"
                    class="form-control @error('identificacion') is-invalid @enderror" value="{{ old('identificacion') }}"
                    required>
                @error('identificacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="codigo_estudiantil">Código Estudiantil</label>
                <input type="text" name="codigo_estudiantil" id="codigo_estudiantil"
                    class="form-control @error('codigo_estudiantil') is-invalid @enderror"
                    value="{{ old('codigo_estudiantil') }}" required>
                @error('codigo_estudiantil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="fotografia">Fotografía</label>
                <input type="file" name="fotografia" id="fotografia"
                    class="form-control @error('fotografia') is-invalid @enderror">
                @error('fotografia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion"
                    class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono"
                    class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo"
                    class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                @error('correo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                    value="{{ old('fecha_nacimiento') }}">
                @error('fecha_nacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="semestre">Semestre</label>
                <input type="number" name="semestre" id="semestre"
                    class="form-control @error('semestre') is-invalid @enderror" value="{{ old('semestre') }}">
                @error('semestre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="estado_civil">Estado Civil</label>
                <input type="text" name="estado_civil" id="estado_civil"
                    class="form-control @error('estado_civil') is-invalid @enderror" value="{{ old('estado_civil') }}">
                @error('estado_civil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                    class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso') }}">
                @error('fecha_ingreso')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="fecha_egreso">Fecha de Egreso</label>
                <input type="date" name="fecha_egreso" id="fecha_egreso"
                    class="form-control @error('fecha_egreso') is-invalid @enderror" value="{{ old('fecha_egreso') }}">
                @error('fecha_egreso')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cohorte_id">Cohorte</label>
                <select name="cohorte_id" id="cohorte_id"
                    class="form-control @error('cohorte_id') is-invalid @enderror">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($cohortes as $cohorte)
                        <option value="{{ $cohorte->id }}" {{ old('cohorte_id') == $cohorte->id ? 'selected' : '' }}>
                            {{ $cohorte->nombre }}</option>
                    @endforeach
                </select>
                @error('cohorte_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="programa_id">Programa</label>
                <select name="programa_id" id="programa_id"
                    class="form-control @error('programa_id') is-invalid @enderror">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->id }}" {{ old('programa_id') == $programa->id ? 'selected' : '' }}>
                            {{ $programa->nombre }}</option>
                    @endforeach
                </select>
                @error('programa_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
