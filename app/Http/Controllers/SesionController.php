<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use App\Models\CursoUser;
use Illuminate\Http\Request;
use DB;

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
        $sesion->color = $request->color;
        $sesion->save();

        $cursouser = new CursoUser();
        $cursouser->cursos_id = $request->cursos_id;
        $cursouser->users_id = $request->docentes_id;
        $cursouser->save();

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

    public function sessions_by_aulas_id(Request $request)
    {
        $sesiones = DB::table('sesions as s')
            ->join('cursos as c', 'c.id', '=', 's.cursos_id')
            ->where('s.aulas_id', $request->aulas_id)
            ->select('s.id', 'c.nombre', 's.fecha_inicio', 's.fecha_fin', 's.allDay', 's.color', 's.textColor')
            ->get();

        return $sesiones;
    }
}
