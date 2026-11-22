@extends('layouts.app')

@section('contenido')
    <h1>Productos registrados</h1>

    <p><a href="{{ route('productos.create') }}">Crear producto</a></p>

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
                <th>Acciones</th>
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
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>

                        <form method="POST" action="{{ route('productos.destroy', $producto->id) }}"
                              onsubmit="return confirm('¿Eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
