@extends('layouts.app')

@section('content')
    <h1>Editar libro</h1>

    <form method="POST" action="{{ route('libros.update', $libro->id) }}">
        @csrf
        @method('PUT')

        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text"
               value="{{ old('codigo', $libro->codigo) }}" required>

        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text"
               value="{{ old('titulo', $libro->titulo) }}" required>

        <label for="autor">Autor</label>
        <input id="autor" name="autor" type="text"
               value="{{ old('autor', $libro->autor) }}" required>

        <label for="anio_publicacion">Año de publicación</label>
        <input id="anio_publicacion" name="anio_publicacion" type="number"
               value="{{ old('anio_publicacion', $libro->anio_publicacion) }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('libros.index') }}">Cancelar</a>
    </form>
@endsection
