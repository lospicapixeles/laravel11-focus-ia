<?php

namespace App\Http\Controllers;

use App\Models\Camara;
use Illuminate\Http\Request;

class CamaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camaras = Camara::get();

        return $camaras;
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
        $camara = new Camara();
        $camara->ip = $request->ip;
        $camara->port = $request->port;
        $camara->user = $request->user;
        $camara->password = $request->password;
        $camara->nombre = $request->nombre;
        $camara->estado = $request->estado;
        $camara->aulas_id = $request->aulas_id;
        $camara->save();

        return response()->json([
            'message' => 'Datos guardados exitosamente',
            'data' => $camara
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Camara $camara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Camara $camara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camara $camara)
    {
        $camara->ip = $request->ip;
        $camara->port = $request->port;
        $camara->user = $request->user;
        $camara->password = $request->password;
        $camara->nombre = $request->nombre;
        $camara->estado = $request->estado;
        $camara->aulas_id = $request->aulas_id;
        $camara->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $camara
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camara $camara)
    {
        $camara->delete();

        return response()->json([
            'message' => 'Dato borrado exitosamente',
            'data' => $camara
        ], 200);
    }
}
