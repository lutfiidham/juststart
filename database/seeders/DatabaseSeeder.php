<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        activity()->disableLogging();
        $this->call(MenuPermissionSeeder::class);
        $this->call(AdditionalPermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SuperAdminSeeder::class);
        activity()->enableLogging();
    }
}
