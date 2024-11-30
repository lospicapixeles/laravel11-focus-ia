<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Emocion;
use Phpml\Math\Distance\Euclidean;
use Illuminate\Http\Request;
use DB;

class EmocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $emociones = []; // Inicializamos un arreglo para almacenar los datos procesados.
        $faces = User::all(); // Cargar descriptores guardados
        $euclidean = new Euclidean();

        foreach ($request->face as $item) {
            // Asegúrate de que $item['descriptor'] sea un array o conviértelo si es necesario.
            $newDescriptor = is_array($item['descriptor']) ? $item['descriptor'] : json_decode($item['descriptor'], true);

            // Si el descriptor es nulo o inválido, continúa con el siguiente item.
            if (!$newDescriptor) {
                continue;
            }

            // Inicializamos variables para encontrar el mejor match.
            $bestMatch = null;
            $bestDistance = INF;

            // Comparar el descriptor del rostro con los almacenados.
            foreach ($faces as $face) {
                // Asegúrate de que $face->face_descriptor sea un array o conviértelo si es necesario.
                $storedDescriptor = is_array($face->face_descriptor) ? $face->face_descriptor : json_decode($face->face_descriptor, true);

                // Si el descriptor almacenado es nulo o inválido, omitir esta cara.
                if (!$storedDescriptor) {
                    continue;
                }

                // Calcula la distancia euclidiana entre los descriptores.
                $distance = $euclidean->distance($newDescriptor, $storedDescriptor);

                if ($distance < $bestDistance) {
                    $bestDistance = $distance;
                    $bestMatch = $face;
                }
            }

            // Determinar el usuario asociado al rostro.
            if ($bestDistance < 0.6 && $bestMatch) { // Solo procesamos si se encuentra un match válido.
                $emociones[] = [

                    'expresiones' => json_encode($item['expressions']),
                    'parametros' => json_encode($item['descriptor']),
                    'sesions_id' => $request->sesions_id,
                    'users_id' => $bestMatch->id, // Asociamos el `users_id` encontrado.
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Solo insertamos si hay emociones válidas.
        if (!empty($emociones)) {
            Emocion::insert($emociones);
        }

        return response()->json([
            'message' => !empty($emociones) ? 'Todas las emociones guardadas exitosamente' : 'No se encontraron coincidencias para los rostros',

        ], !empty($emociones) ? 201 : 400); // Código de respuesta según el caso.
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

    public function get_emociones()
    {

       // Obtener todas las emociones
        $emociones = Emocion::pluck('expresiones'); // Asumiendo que la columna se llama 'emocion'

        // Variables para almacenar las sumas
        $sumaEmociones = [
            'sad' => 0,
            'angry' => 0,
            'happy' => 0,
            'fearful' => 0,
            'neutral' => 0,
            'disgusted' => 0,
            'surprised' => 0,
        ];

        // Contador de registros
        $totalRegistros = count($emociones);

        // Sumar los valores de cada emoción
        foreach ($emociones as $emocion) {
            $emocionData = json_decode($emocion, true); // Decodificar el JSON

            foreach ($sumaEmociones as $key => &$value) {
                $value += $emocionData[$key] ?? 0; // Sumar valores, usar 0 si no existe la clave
            }
        }

        // Calcular el promedio
        $promedioEmociones = [];
        foreach ($sumaEmociones as $key => $value) {
            $promedioEmociones[$key] = $totalRegistros > 0 ? $value / $totalRegistros : 0;
        }

        // Retornar el promedio como respuesta JSON
        return response()->json($promedioEmociones);
    }

    public function get_emociones_by_sesions_id(Request $request)
    {

       $emociones = DB::table('emocions as e')
            ->join('sesions as s', 's.id', '=', 'e.sesions_id')
            ->join('users as u', 'u.id', '=', 'e.users_id')
            ->where('s.id', $request->sesions_id)
            ->pluck('e.expresiones');

       // Variables para almacenar las sumas
        $sumaEmociones = [
            'sad' => 0,
            'angry' => 0,
            'happy' => 0,
            'fearful' => 0,
            'neutral' => 0,
            'disgusted' => 0,
            'surprised' => 0,
        ];

        // Contador de registros
        $totalRegistros = count($emociones);

        // Sumar los valores de cada emoción
        foreach ($emociones as $emocion) {
            $emocionData = json_decode($emocion, true); // Decodificar el JSON

            foreach ($sumaEmociones as $key => &$value) {
                $value += $emocionData[$key] ?? 0; // Sumar valores, usar 0 si no existe la clave
            }
        }

        // Calcular el promedio
        $promedioEmociones = [];
        foreach ($sumaEmociones as $key => $value) {
            $promedioEmociones[$key] = $totalRegistros > 0 ? $value / $totalRegistros : 0;
        }

        // Retornar el promedio como respuesta JSON
        return response()->json($promedioEmociones);
    }

    public function get_emociones_users_by_sesions_id(Request $request)
    {
        $resultados = DB::table('users as u')
                    ->join('emocions as e', 'e.users_id', '=', 'u.id')
                    ->join('sesions as s', 's.id', '=', 'e.sesions_id')
                    ->where('s.id', $request->sesions_id)
                    ->select('u.name', 'e.expresiones')
                    ->get();

        // Formatear las emociones
        $resultadoFormateado = $resultados->map(function($item) {
            // Decodificar el JSON para obtener las emociones
            $emociones = json_decode($item->expresiones, true);

            // Obtener la emoción principal (la de mayor valor)
            $emocionPrincipal = array_search(max($emociones), $emociones);

            // Devolver el formato deseado
            return [
                'name' => $item->name,
                'emocion' => $emocionPrincipal
            ];
        });

        // Eliminar duplicados por 'name' y 'emocion', asegurándose de que solo haya una emoción principal por usuario
        $resultadoSinDuplicados = $resultadoFormateado->unique(function($item) {
            return $item['name'];
        });

        // Devolver los resultados como JSON
        return response()->json($resultadoSinDuplicados);
    }
}
