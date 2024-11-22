<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $buscar = "";
        if ($request->buscar) {
            $buscar = $request->buscar;
        }

        $users = User::where('name', 'like', '%' . $buscar . '%')
            ->orWhere('email', 'like', '%' . $buscar . '%')
            ->orderBy('id', 'desc')
            ->paginate($request->cant_reg);

        return $users;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'face_descriptor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Por favor, corrige los errores en los campos indicados.',
                'errors' => $validator->errors()
            ], 400);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->face_descriptor = $request->face_descriptor;
        $user->face_image_url = $request->face_image_url;
        $user->rol = $request->rol;
        $user->save();

        return response()->json([
            'message' => 'User successfully registered',
        ], 200);

    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return response()->json([
            'message' => 'Usuario eliminado con éxito! :)',
        ], 200);
    }

    public function docentes_combo()
    {
        $usersCombo = DB::table('users')
            ->select('id as codigo', 'name as descripcion')
            ->where('rol', 'docente')
            ->get();

        return $usersCombo;
    }
}
