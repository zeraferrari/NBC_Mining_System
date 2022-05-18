<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      =>  'Administrator',
                'email'     =>  'administrator@admin.com',
                'password'  =>  Hash::make('admin1122'),
                'NIK'       =>  '1122334455667788',
                'Gender'    =>  'Laki-laki',
                'phone_number'  =>  '0211404514045',
                'alamat'        =>  'Jalan Palang Merah Indonesia, Kota Samarinda Kalimantan Timur',
                'Status_Donor'  =>  'Belum Mendonor',
                'Rhesus_id'     =>  NULL
            ],
            [
                'name'      =>  'Raudhatun Nisya',
                'email'     =>  'atun_nisya@gmail.com',
                'password'  =>  Hash::make('atun1122'),
                'NIK'       =>  '647205010000013',
                'Gender'    =>  'Perempuan',
                'phone_number'  =>  '081250063932',
                'alamat'        =>  'Jalan M.Yamin Gang Rambutan Gunung Kelua, Kota Samarinda',
                'Status_Donor'  =>  'Belum Mendonor',
                'Rhesus_id'     =>  '7'
            ],
            [
                'name'      =>  'Zacky Burhan',
                'email'     =>  'burha_unyu@gmail.com',
                'password'  =>  Hash::make('unyuunyu123'),
                'NIK'       =>  '6472050103012390',
                'Gender'    =>  'Laki-laki',
                'phone_number'  =>  '081344557493',
                'alamat'        =>  'Jalan Sutomo Gang 2, Kota Samarinda',
                'Status_Donor'  =>  'Belum Mendonor',
                'Rhesus_id'     =>  '5'
            ],
        ];
        DB::table('users')->insert($users);
    }
}
