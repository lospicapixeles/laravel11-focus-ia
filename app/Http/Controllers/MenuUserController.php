<?php

namespace App\Http\Controllers;

use App\Models\MenuUser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class MenuUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();
        //retornar menus de usuario
        $menuUsers = DB::table("menus")
            ->join("menu_users", "menu_users.menus_id", "=", "menus.id")
            ->where("menu_users.users_id", $user->id)
            ->select("menus.*")
            ->get()
            ->toArray();

        function buildMenuTree($menus, $parentId = null)
        {
            $tree = [];

            foreach ($menus as $menu) {
                if ($menu->menus_id == $parentId) {
                    // Acceder a las propiedades como objeto
                    $children = buildMenuTree($menus, $menu->id); // Acceder a las propiedades como objeto
                    if (!empty($children)) {
                        $menu->children = $children; // Acceder a las propiedades como objeto
                    }
                    $tree[] = $menu; // Acceder a las propiedades como objeto
                }
            }

            return $tree;
        }

        $menuTree = buildMenuTree($menuUsers, null);

        return $menuTree;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuUser $menuUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuUser $menuUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuUser $menuUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuUser $menuUser)
    {
        //
    }
}
