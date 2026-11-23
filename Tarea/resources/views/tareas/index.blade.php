@extends('layouts.app')

@section('contenido')
    <h1>Tareas registradas</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Fecha límite</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->responsable }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($tarea->fecha_limite)->format('d/m/Y') }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->created_at }}</td>
                    <td>{{ $tarea->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay tareas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
