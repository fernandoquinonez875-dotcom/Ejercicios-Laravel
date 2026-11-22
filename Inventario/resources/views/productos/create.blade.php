@extends('layouts.app')

@section('contenido')
    <h1>Crear producto</h1>
    <form method="POST" action="{{ route('productos.store') }}">
        @csrf

        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text" maxlength="255" value="{{ old('codigo') }}" required>

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" maxlength="100" value="{{ old('nombre') }}" required>

        <label for="precio">Precio</label>
        <input id="precio" name="precio" type="number" min="0.01" max="9999999999.99" step="0.01" value="{{ old('precio') }}" required>

        <label for="existencias">Existencias</label>
        <input id="existencias" name="existencias" type="number" min="0" max="4294967295" step="1" value="{{ old('existencias') }}" required>

        <button type="submit">Guardar</button>
        <a href="{{ route('productos.index') }}">Cancelar</a>
    </form>
@endsection
