<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use Illuminate\Http\Request;

class EmocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Emociones = Emocion::get();

        return $Emociones;
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
        $Emocion = new Emocion();
        $Emocion->expresiones = $request->expresiones;
        $Emocion->parametros = $request->parametros;
        $Emocion->sesions_id = $request->sesions_id;
        $emocion->users_id = $request->users_id;
        $Emocion->save();

        return response()->json([
            'message' => 'Datos guardados exitosamente',
            'data' => $Emocion
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emocion $emocion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emocion $emocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emocion $emocion)
    {
        $Emocion->expresiones = $request->expresiones;
        $Emocion->parametros = $request->parametros;
        $Emocion->sesions_id = $request->sesions_id;
        $emocion->users_id = $request->users_id;
        $Emocion->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $Emocion
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emocion $emocion)
    {
        $Emocion->delete();

        return response()->json([
            'message' => 'Datos borrados exitosamente',
            'data' => $Emocion
        ], 200);
    }
}
