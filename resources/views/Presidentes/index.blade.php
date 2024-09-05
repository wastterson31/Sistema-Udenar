@extends('administrador.index')

@section('content')
    <h1>Presidentes</h1>
    <a href="{{ route('presidentes.create') }}" class="btn btn-primary">Crear Presidente</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presidentes as $presidente)
                <tr>
                    <td>{{ $presidente->nombre }}</td>
                    <td>{{ $presidente->identificacion }}</td>
                    <td>{{ $presidente->correo }}</td>
                    <td>
                        <a href="{{ route('presidentes.edit', $presidente) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('presidentes.destroy', $presidente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
