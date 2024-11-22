<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use DB;

class AulaController extends Controller
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

        $aulas = Aula::where('nombre', 'like', '%' . $buscar . '%')
            ->orWhere('ubicacion', 'like', '%' . $buscar . '%')
            ->orderBy('id', 'desc')
            ->paginate($request->cant_reg);

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
        $aula->nombre = $request->nombre;
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

    public function aulas_combo(Request $request)
    {
        $aulasCombo = DB::table('aulas')->select('id as codigo', 'nombre as descripcion')->get();

        return $aulasCombo;
    }
}
