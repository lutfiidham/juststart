<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name'              => 'Super Admin',
            'email'             => 'superadmin@vsualproject.com',
            'email_verified_at' => now(),
            'password'          => 'superadmin',
        ]);
        $superadmin->assignRole('Super Admin');
    }
}
