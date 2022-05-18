<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class model_has_roles_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model_role = [
            [
                'role_id'       =>  '1',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '1'
            ],
            [
                'role_id'       =>  '2',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '2'
            ],
            [
                'role_id'       =>  '3',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '3'
            ],
        ];

        DB::table('model_has_roles')->insert($model_role);
    }
}
