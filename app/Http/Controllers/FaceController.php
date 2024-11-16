<?php

namespace App\Http\Controllers;
use Phpml\Math\Distance\Euclidean;
use App\Models\Face;
use Illuminate\Http\Request;

class FaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faces = Face::all(); // Cargar descriptores guardados
        $euclidean = new Euclidean();
        $bestMatch = null;
        $bestDistance = INF;

        // Convierte el nuevo descriptor recibido en un array
        $newDescriptor = json_decode($request->newDescriptor, true);

        foreach ($faces as $face) {
            // Convierte el descriptor almacenado en la base de datos en un array
            $descriptor = json_decode($face->face_descriptor, true);
            
            // Calcula la distancia euclidiana entre descriptores
            $distance = $euclidean->distance($newDescriptor, $descriptor);

            if ($distance < $bestDistance) {
                $bestDistance = $distance;
                $bestMatch = $face;
            }
        }

        return $bestDistance < 0.6 ? $bestMatch : null;
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
        $data = $request->validate([
            'image_path' => 'required|string',
            'faces' => 'required|array',
            'faces.*.descriptor' => 'required|array', // Validar que cada cara tenga un descriptor
        ]);

        foreach ($data['faces'] as $faceData) {
            $face = new Face();
            $face->image_path = $data['image_path'];
            $face->face_descriptor = json_encode($faceData['descriptor']);
            $face->save(); 
        }

        return response()->json([
            'message' => 'Datos guardados exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Face $face)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Face $face)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Face $face)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Face $face)
    {
        //
    }
}
