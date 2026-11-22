@extends('layouts.app')

@section('content')
    <h1>Libros registrados</h1>
    <p><a href="{{ route('libros.create') }}">Crear libro</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año de publicación</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->codigo }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $libro->anio_publicacion }}</td>
                    <td>{{ $libro->created_at }}</td>
                    <td>{{ $libro->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay libros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection