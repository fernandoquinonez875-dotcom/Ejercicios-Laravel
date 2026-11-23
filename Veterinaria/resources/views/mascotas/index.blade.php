@extends('layouts.app')

@section('contenido')
    <h1>Mascotas registradas</h1>

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
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay mascotas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
