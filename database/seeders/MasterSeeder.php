<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuUser;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $menus = [
            [
                'name' => 'Mantenimiento',
                'path' => '#',
                'icon' => 'gear',
                'menus_id' => null,
            ],
            [
                'name' => 'Usuarios',
                'path' => '/usuarios',
                'icon' => 'users',
                'menus_id' => 1,
            ],
            [
                'name' => 'Aulas',
                'path' => '/aulas',
                'icon' => 'chalkboard-user',
                'menus_id' => 1,
            ],
            [
                'name' => 'Cursos',
                'path' => '/cursos',
                'icon' => 'book',
                'menus_id' => 1,
            ],
            [
                'name' => 'Horarios',
                'path' => '/horarios',
                'icon' => 'clock',
                'menus_id' => 1,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        $menus_id = 1;
        
        foreach ($menus as $menu) {
            MenuUser::create([
                'users_id' => 1,
                'menus_id' => $menus_id,
            ]);
            $menus_id++;
        }

        
    }
}
