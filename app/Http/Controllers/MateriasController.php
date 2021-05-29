<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;

class MateriasController extends Controller
{
    public function index()
    {
        $materias = Materias::all()->toArray();
        return array_reverse($materias);      
    }

    public function store(Request $request)
    {
        $materias = new Materias([
            'nombre' => $request->input('nombre'),
            'docente' => $request->input('docente'),
            'tipo' => $request->input('tipo'),
        ]);
        $materias->save();

        return $materias;
    }

    public function show($id)
    {
        $materias = Materias::find($id);
        return response()->json($materias);
    }

    public function update($id, Request $request)
    {
        $materias = Materias::find($id);
        $materias->update($request->all());

        return response()->json('Materia actualizada!');
    }

    public function destroy($id)
    {
        $Materias = Materias::find($id);
        $Materias->delete();

        return response()->json('Materias eliminada!');
    }}
