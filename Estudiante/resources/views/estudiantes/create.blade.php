@extends('layouts.app')

@section('contenido')
    <h1>Crear estudiante</h1>
    <form method="POST" action="{{ route('estudiantes.store') }}">
        @csrf

        <label for="numero_cuenta">Número de cuenta</label>
        <input id="numero_cuenta" name="numero_cuenta" type="text" maxlength="255" value="{{ old('numero_cuenta') }}" required>

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" maxlength="100" value="{{ old('nombre') }}" required>

        <label for="correo">Correo electrónico</label>
        <input id="correo" name="correo" type="email" maxlength="255" value="{{ old('correo') }}" required>

        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento') }}" required>

        <button type="submit">Guardar</button>
        <a href="{{ route('estudiantes.index') }}">Cancelar</a>
    </form>
@endsection
