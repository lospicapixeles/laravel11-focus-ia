<?php

namespace App\Http\Controllers;

use App\Models\camara;
use Illuminate\Http\Request;

class CamaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camaras = camara::get();

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
        $camara = new camara();
        $camara->ip = $request->ip;
        $camara->port = $request->port;
        $camara->user = $request->user;
        $camara->password = $request->password;
        $camara->status = $request->status;
        $camara->info = $request->info;
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
    public function show(camara $camara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(camara $camara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, camara $camara)
    {
        $camara->ip = $request->ip;
        $camara->port = $request->port;
        $camara->user = $request->user;
        $camara->password = $request->password;
        $camara->status = $request->status;
        $camara->info = $request->info;
        $camara->aulas_id = $request->aulas_id;
        $camara->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $aula
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(camara $camara)
    {
        $camara->delete();

        return response()->json([
            'message' => 'Dato borrado exitosamente',
            'data' => $aula
        ], 200);
    }
}
