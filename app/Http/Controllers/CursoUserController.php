<?php

namespace App\Http\Controllers;

use App\Models\CursoUser;
use Illuminate\Http\Request;

class CursoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursoUsers = CursoUser::get();

        return $cursoUsers;
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
        $CursoUser = new CursoUser();
        $CursoUser->cursos_id = $request->cursos_id;
        $CursoUser->users_id = $request->users_id;
        $CursoUser->save();

        return response()->json([
            'message' => 'Datos Guardados exitosamente',
            'data' => $CursoUser
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CursoUser $cursoUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CursoUser $cursoUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CursoUser $cursoUser)
    {
        $CursoUser->cursos_id = $request->cursos_id;
        $CursoUser->users_id = $request->users_id;
        $CursoUser->save();

        return response()->json([
            'message' => 'Datos actualizados exitosamente',
            'data' => $CursoUser
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CursoUser $cursoUser)
    {
        $cursoUser->delete();

        return response()->json([
            'message' => 'Datos borrados exitosamente',
            'data' => $CursoUser
        ], 200);
    }
}
