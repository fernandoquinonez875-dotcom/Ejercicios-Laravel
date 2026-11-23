@extends('layouts.app')

@section('contenido')
    <h1>Editar estudiante</h1>
    <form method="POST" action="{{ route('estudiantes.update', $estudiante->id) }}">
        @csrf
        @method('PUT')

        <label for="numero_cuenta">Número de cuenta</label>
        <input id="numero_cuenta" name="numero_cuenta" type="text" maxlength="255" value="{{ old('numero_cuenta', $estudiante->numero_cuenta) }}" required>

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" maxlength="100" value="{{ old('nombre', $estudiante->nombre) }}" required>

        <label for="correo">Correo electrónico</label>
        <input id="correo" name="correo" type="email" maxlength="255" value="{{ old('correo', $estudiante->correo) }}" required>

        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('estudiantes.index') }}">Cancelar</a>
    </form>
@endsection
