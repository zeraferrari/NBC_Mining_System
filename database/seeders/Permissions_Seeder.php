<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permissions_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'          =>  'Mengakses Dashboard Master Data',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Role Baru',
                'guard_name'    =>  'web'
            ],
            [
                'name'          =>  'Mengupdate Detail Role',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Role',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Hak Akses Role',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Hak Akses Role',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Hak Akses Role',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Kategori Rhesus Baru',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Kategori Rhesus',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Kategori Rhesus',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Akun User Baru',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Melihat Detail Akun User',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Akun User',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Akun User',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Data Training',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Data Training',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Data Training',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Membuat Data Testing',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Data Testing',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Melihat Detail Data Testing',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Menghapus Data Testing',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Melakukan Transaksi Donor',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mengupdate Transaksi Donor',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Melihat Detail Hasil Klasifikasi Donor',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'Mendownload Data PDF Hasil Klasifikasi',
                'guard_name'    =>  'web',
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
