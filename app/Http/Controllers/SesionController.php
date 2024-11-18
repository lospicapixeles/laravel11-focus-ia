<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesiones = Sesion::get();

        return $sesiones;
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
        $sesion = new Sesion();
        $sesion->fecha_inicio = $request->fecha_inicio;
        $sesion->fecha_fin = $request->fecha_fin;
        $sesion->aulas_id = $request->aulas_id;
        $sesion->cursos_id = $request->cursos_id;
        $sesion->save();

        return response()->json([
            'message' => 'Datos guardados exitosamente',
            'data' => $sesion
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesion $sesion)
    {
        $sesion->fecha_inicio = $request->fecha_inicio;
        $sesion->fecha_fin = $request->fecha_fin;
        $sesion->aulas_id = $request->aulas_id;
        $sesion->cursos_id = $request->cursos_id;
        $sesion->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $sesion
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesion $sesion)
    {
        $sesion->delete();

        return response()->json([
            'message' => 'Datos borrados exitosamente',
            'data' => $sesion
        ], 200);
    }
}
