@extends('layouts.app')

@section('contenido')
    <h1>Productos registrados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencias</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ number_format((float) $producto->precio, 2, '.', '') }}</td>
                    <td>{{ (int) $producto->existencias === 0 ? 'Sin existencias' : $producto->existencias }}</td>
                    <td>{{ $producto->created_at }}</td>
                    <td>{{ $producto->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
