@extends('layouts.app')

@section('contenido')
    <h1>Mascotas registradas</h1>

    <p><a href="{{ route('mascotas.create') }}">Crear mascota</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Propietario</th>
                <th>Fecha de nacimiento</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mascotas as $mascota)
                <tr>
                    <td>{{ $mascota->id }}</td>
                    <td>{{ $mascota->codigo }}</td>
                    <td>{{ $mascota->nombre }}</td>
                    <td>{{ $mascota->especie }}</td>
                    <td>{{ $mascota->propietario }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($mascota->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $mascota->created_at }}</td>
                    <td>{{ $mascota->updated_at }}</td>
                    <td>
                        <a href="{{ route('mascotas.edit', $mascota->id) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No hay mascotas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
