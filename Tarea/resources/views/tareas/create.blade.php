@extends('layouts.app')

@section('contenido')
    <h1>Crear tarea</h1>
    <form method="POST" action="{{ route('tareas.store') }}">
        @csrf

        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="150" value="{{ old('titulo') }}" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" maxlength="500" required>{{ old('descripcion') }}</textarea>

        <label for="responsable">Responsable</label>
        <input id="responsable" name="responsable" type="text" maxlength="100" value="{{ old('responsable') }}" required>

        <label for="fecha_limite">Fecha límite</label>
        <input id="fecha_limite" name="fecha_limite" type="date" value="{{ old('fecha_limite') }}" required>

        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="">Selecciona una opción</option>
            <option value="pendiente" @selected(old('estado') === 'pendiente')>Pendiente</option>
            <option value="en proceso" @selected(old('estado') === 'en proceso')>En proceso</option>
            <option value="completada" @selected(old('estado') === 'completada')>Completada</option>
        </select>

        <button type="submit">Guardar</button>
        <a href="{{ route('tareas.index') }}">Cancelar</a>
    </form>
@endsection
