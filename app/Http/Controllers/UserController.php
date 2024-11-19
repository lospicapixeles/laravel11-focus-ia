<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
