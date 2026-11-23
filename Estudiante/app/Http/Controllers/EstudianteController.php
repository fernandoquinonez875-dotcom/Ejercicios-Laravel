<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::orderBy('id')->get();

        return view('estudiantes.index', ['estudiantes' => $estudiantes]);
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'numero_cuenta' => ['required', 'string', 'max:255', 'unique:estudiantes,numero_cuenta'],
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:255', 'unique:estudiantes,correo'],
            'fecha_nacimiento' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
        ]);

        $estudiante = new Estudiante();
        $estudiante->numero_cuenta = $datos['numero_cuenta'];
        $estudiante->nombre = $datos['nombre'];
        $estudiante->correo = $datos['correo'];
        $estudiante->fecha_nacimiento = $datos['fecha_nacimiento'];
        $estudiante->save();

        return redirect()->route('estudiantes.index')->with('exito', 'Estudiante creado correctamente.');
    }
}
