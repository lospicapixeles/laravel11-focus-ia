<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $aulas = Aula::get();
       
       return $aulas;
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
        $aula = new Aula();
        $aula->name = $request->name;
        $aula->ubicacion = $request->ubicacion;
        $aula->save();

        return response()->json([
            'message' => 'Datos guardados exitosamente',
            'data' => $aula
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aula $aula)
    {
        $aula->name = $request->name;
        $aula->ubicacion = $request->ubicacion;
        $aula->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $aula
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        $aula->delete();

        return response()->json([
            'message' => 'Dato borrado exitosamente',
            'data' => $aula
        ], 200);
    }
}
