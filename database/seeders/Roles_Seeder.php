<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'          => 'Administrator',
                'guard_name'    => 'web'
            ],

            [
                'name'          =>  'Petugas Medis',
                'guard_name'    =>  'web'
            ],
            
            [
                'name'          =>  'Pendonor',
                'guard_name'    =>  'web'
            ]
        ];
    
        DB::table('roles')->insert($roles);
    }
}
