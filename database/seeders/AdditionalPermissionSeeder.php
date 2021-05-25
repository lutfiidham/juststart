<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class AdditionalPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'        => 'profile.update',
            'description' => 'Update Profile',
        ]);
        Permission::create([
            'name'        => 'profile.change-password',
            'description' => 'Change Password',
        ]);
    }
}
