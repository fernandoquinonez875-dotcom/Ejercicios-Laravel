@extends('layouts.app')

@section('contenido')
    <h1>Editar tarea</h1>
    <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
        @csrf
        @method('PUT')

        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="150" value="{{ old('titulo', $tarea->titulo) }}" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" maxlength="500" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>

        <label for="responsable">Responsable</label>
        <input id="responsable" name="responsable" type="text" maxlength="100" value="{{ old('responsable', $tarea->responsable) }}" required>

        <label for="fecha_limite">Fecha límite</label>
        <input id="fecha_limite" name="fecha_limite" type="date" value="{{ old('fecha_limite', $tarea->fecha_limite) }}" required>

        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="">Selecciona una opción</option>
            <option value="pendiente" @selected(old('estado', $tarea->estado) === 'pendiente')>Pendiente</option>
            <option value="en proceso" @selected(old('estado', $tarea->estado) === 'en proceso')>En proceso</option>
            <option value="completada" @selected(old('estado', $tarea->estado) === 'completada')>Completada</option>
        </select>

        <button type="submit">Actualizar</button>
        <a href="{{ route('tareas.index') }}">Cancelar</a>
    </form>
@endsection
