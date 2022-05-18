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
        // \App\Models\User::factory(10)->create();
        $this->call([
            Blood_Categories_Seeder::class,
            Roles_Seeder::class,
            Permissions_Seeder::class,
            Users_Seeder::class,
            model_has_roles_seeder::class,
            roles_has_permissions_seeder::class
        ]);
    }
}
