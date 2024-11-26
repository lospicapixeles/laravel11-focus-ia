<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = "";
        if ($request->buscar) {
            $buscar = $request->buscar;
        }

        $cursos = Curso::where('nombre', 'like', '%' . $buscar . '%')
            ->orWhere('descripcion', 'like', '%' . $buscar . '%')
            ->orderBy('id', 'desc')
            ->paginate($request->cant_reg);

        return $cursos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $curso =  new Curso();
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->creditos = $request->creditos;
        $curso->save();

        return response()->json([
            'message' => 'Datos guardados exitosamente',
            'data' => $curso
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->creditos = $request->creditos;
        $curso->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $curso
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response()->json([
            'message' => 'Datos borrados exitosamente',
            'data' => $curso
        ], 200);
    }

    public function cursos_combo(Request $request)
    {
        $cursosCombo = DB::table('cursos')
            ->select('id as codigo', 'nombre as descripcion')
            ->get();

        return $cursosCombo;

    }
}
