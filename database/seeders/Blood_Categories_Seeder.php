<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blood_Categories_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Blood_Categories = [
            [
                'Name'  =>  'A+'
            ],

            [
                'Name'  =>  'A-'
            ],

            [
                'Name'  =>  'B+'
            ],

            [
                'Name'  =>  'B-'
            ],

            [
                'Name'  =>  'O+'
            ],

            [
                'Name'  =>  'O-'
            ],

            [
                'Name'  =>  'AB+'
            ],

            [
                'Name'  =>  'AB-'
            ],
        ];

        DB::table('rhesus_categories')->insert($Blood_Categories);
    }
}
