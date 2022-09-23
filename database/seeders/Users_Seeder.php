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
                'name'      =>  'Anselma Putri',
                'email'     =>  'ansel_putri@gmail.com',
                'password'  =>  Hash::make('ansel123'),
                'NIK'       =>  '6473211234567001',
                'Gender'    =>  'Perempuan',
                'phone_number'  =>  '081125671234',
                'alamat'        =>  'Jalan M.Yamin Gang Rambutan Gunung Kelua, Kota Samarinda',
                'Status_Donor'  =>  'Belum Mendonor',
                'Rhesus_id'     =>  '7'
            ],
            [
                'name'      =>  'Zacky Burhan',
                'email'     =>  'burhan_unyu@gmail.com',
                'password'  =>  Hash::make('unyuunyu123'),
                'NIK'       =>  '6473211234567002',
                'Gender'    =>  'Laki-laki',
                'phone_number'  =>  '081345671234',
                'alamat'        =>  'Jalan Sutomo Gang 2, Kota Samarinda',
                'Status_Donor'  =>  'Belum Mendonor',
                'Rhesus_id'     =>  '5'
            ],
        ];
        DB::table('users')->insert($users);
    }
}
