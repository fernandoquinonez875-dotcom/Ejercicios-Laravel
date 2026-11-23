@extends('layouts.app')

@section('contenido')
    <h1>Editar mascota</h1>
    <form method="POST" action="{{ route('mascotas.update', $mascota->id) }}">
        @csrf
        @method('PUT')

        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text" maxlength="255" value="{{ old('codigo', $mascota->codigo) }}" required>

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" maxlength="80" value="{{ old('nombre', $mascota->nombre) }}" required>

        <label for="especie">Especie</label>
        <select id="especie" name="especie" required>
            <option value="">Selecciona una opción</option>
            <option value="perro" @selected(old('especie', $mascota->especie) === 'perro')>Perro</option>
            <option value="gato" @selected(old('especie', $mascota->especie) === 'gato')>Gato</option>
            <option value="otro" @selected(old('especie', $mascota->especie) === 'otro')>Otro</option>
        </select>

        <label for="propietario">Propietario</label>
        <input id="propietario" name="propietario" type="text" maxlength="100" value="{{ old('propietario', $mascota->propietario) }}" required>

        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento', $mascota->fecha_nacimiento) }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('mascotas.index') }}">Cancelar</a>
    </form>
@endsection
