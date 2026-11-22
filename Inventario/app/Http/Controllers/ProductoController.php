<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('id')->get();

        return view('productos.index', ['productos' => $productos]);
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:255', 'unique:productos,codigo'],
            'nombre' => ['required', 'string', 'max:100'],
            'precio' => ['required', 'numeric', 'decimal:0,2', 'min:0.01', 'max:9999999999.99'],
            'existencias' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ]);

        $producto = new Producto();
        $producto->codigo = $datos['codigo'];
        $producto->nombre = $datos['nombre'];
        $producto->precio = $datos['precio'];
        $producto->existencias = $datos['existencias'];
        $producto->save();

        return redirect()->route('productos.index')->with('exito', 'Producto creado correctamente.');
    }

    public function edit(int $id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', ['producto' => $producto]);
    }

    public function update(Request $request, int $id)
    {
        $producto = Producto::findOrFail($id);
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:255', Rule::unique('productos', 'codigo')->ignore($producto)],
            'nombre' => ['required', 'string', 'max:100'],
            'precio' => ['required', 'numeric', 'decimal:0,2', 'min:0.01', 'max:9999999999.99'],
            'existencias' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ]);

        $producto->codigo = $datos['codigo'];
        $producto->nombre = $datos['nombre'];
        $producto->precio = $datos['precio'];
        $producto->existencias = $datos['existencias'];
        $producto->save();

        return redirect()->route('productos.index')->with('exito', 'Producto actualizado correctamente.');
    }
}
