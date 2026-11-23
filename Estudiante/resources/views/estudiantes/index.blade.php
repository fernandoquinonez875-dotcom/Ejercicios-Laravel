@extends('layouts.app')

@section('contenido')
    <h1>Estudiantes registrados</h1>

    <p><a href="{{ route('estudiantes.create') }}">Crear estudiante</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de cuenta</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Fecha de nacimiento</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->id }}</td>
                    <td>{{ $estudiante->numero_cuenta }}</td>
                    <td>{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->correo }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $estudiante->created_at }}</td>
                    <td>{{ $estudiante->updated_at }}</td>
                    <td>
                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay estudiantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
