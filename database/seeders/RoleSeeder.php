<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $permissions = Permission::all();
        $role->syncPermissions($permissions);

        $menus = Menu::all();
        $role->menus()->sync($menus);
    }
}
