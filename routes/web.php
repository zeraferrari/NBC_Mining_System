<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard_NBC;
use App\Http\Controllers\DataTestingController;
use App\Http\Controllers\DataTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RhesusCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionDonorController;
use App\Http\Controllers\UserController;
use App\Models\DataTesting;
use App\Models\TransactionDonor;
use App\Models\User;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// })->name('Home');

Route::GET('/', [HomeController::class, 'index'])->name('home');
Route::GET('/History-Donor', [HomeController::class, 'CekHistoryDonor'])->name('checking_history')->middleware('role:Pendonor|Petugas Medis');
Route::GET('/History-Donor/{TransactionDonor:Code_Transaction}', [HomeController::class, 'CekTransactionHistory'])->name('checking_transaction')->middleware('role:Pendonor|Petugas Medis');

Auth::routes();


Route::GET('Manajement/Dashboard', [Dashboard::class, 'index'])->name('Manajement.Dashboard.index')->middleware('role:Administrator|Petugas Medis');
Route::GET('Manajement/Naive-Bayes-Dashboard', [Dashboard_NBC::class, 'index'])->name('Manajement.NBC_Dashboard.index')->middleware('role:Administrator|Petugas Medis');

Route::GET('Manajement/Role', [RoleController::class, 'index'])->name('Manajement.Roles.index')->middleware('role:Administrator');
Route::GET('Manajement/Role/Create', [RoleController::class, 'create'])->name('Manajement.Roles.create')->middleware('role_or_permission:Administrator|Membuat Role Baru');
Route::POST('Manajement/Role', [RoleController::class, 'store'])->name('Manajement.Roles.store')->middleware('role:Administrator');
Route::GET('Manajement/Role/{id}/Edit', [RoleController::class, 'edit'])->name('Manajement.Roles.edit')->middleware('role_or_permission:Administrator|Mengupdate Detail Role');
Route::PATCH('Manajement/Role/{id}', [RoleController::class, 'update'])->name('Manajement.Roles.update')->middleware('role:Administrator');
Route::DELETE('Manajement/Role/{id}', [RoleController::class, 'destroy'])->name('Manajement.Roles.delete')->middleware('role_or_permission:Administrator|Menghapus Role');


Route::GET('Manajement/Permission', [PermissionController::class, 'index'])->name('Manajement.Permissions.index')->middleware('role:Administrator');
Route::GET('Manajement/Permission/Create', [PermissionController::class, 'create'])->name('Manajement.Permissions.create')->middleware('role_or_permission:Administrator|Membuat Hak Akses Role');
Route::POST('Manajement/Permission', [PermissionController::class, 'store'])->name('Manajement.Permissions.store')->middleware('role:Administrator');
Route::GET('Manajement/Permission/{id}/Edit', [PermissionController::class, 'edit'])->name('Manajement.Permissions.edit')->middleware('role_or_permission:Administrator|Mengupdate Hak Akses Role');
Route::PATCH('Manajement/Permission/{id}', [PermissionController::class, 'update'])->name('Manajement.Permissions.update')->middleware('role:Administrator');
Route::DELETE('Manajement/Permission/{id}', [PermissionController::class, 'destroy'])->name('Manajement.Permissions.delete')->middleware('role_or_permission:Administrator|Menghapus Hak Akses Role');

Route::GET('Manajement/Rhesus-Categories', [RhesusCategoryController::class, 'index'])->name('Manajement.Rhesus.index')->middleware('role:Administrator');
Route::GET('Manajement/Rhesus-Categories/Create', [RhesusCategoryController::class, 'create'])->name('Manajement.Rhesus.create')->middleware('role_or_permission:Administrator|Membuat Kategori Rhesus Baru');
Route::POST('Manajement/Rhesus-Categories', [RhesusCategoryController::class, 'store'])->name('Manajement.Rhesus.store')->middleware('role:Administrator');
Route::GET('Manajement/Rhesus-Categories/{id}/Edit', [RhesusCategoryController::class, 'edit'])->name('Manajement.Rhesus.edit')->middleware('role_or_permission:Administrator|Mengupdate Kategori Rhesus');
Route::PATCH('Manajement/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'update'])->name('Manajement.Rhesus.update')->middleware('role:Administrator');
Route::DELETE('Manajement/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'destroy'])->name('Manajement.Rhesus.delete')->middleware('role_or_permission:Administrator|Menghapus Kategori Rhesus');

Route::GET('Manajement/Data-Trainings', [DataTrainingController::class, 'index'])->name('Manajement.DataTrainings.index')->middleware('role:Administrator');
Route::GET('Manajement/Data-Trainings/Create', [DataTrainingController::class, 'create'])->name('Manajement.DataTrainings.create')->middleware('role_or_permission:Administrator|Membuat Data Training');
Route::POST('Manajement/Data-Trainings', [DataTrainingController::class, 'store'])->name('Manajement.DataTrainings.store')->middleware('role:Administrator');
Route::GET('Manajement/Data-Trainings/{id}/Edit', [DataTrainingController::class, 'edit'])->name('Manajement.DataTrainings.edit')->middleware('role_or_permission:Administrator|Mengupdate Data Training');
Route::PATCH('Manajement/Data-Trainings/{id}', [DataTrainingController::class, 'update'])->name('Manajement.DataTrainings.update')->middleware('role:Administrator');
Route::DELETE('Manajement/Data-Trainings/{id}', [DataTrainingController::class, 'destroy'])->name('Manajement.DataTrainings.delete')->middleware('role_or_permission:Administrator|Menghapus Data Training');

Route::GET('Manajement/Data-Testings', [DataTestingController::class, 'index'])->name('Manajement.DataTestings.index')->middleware('role:Administrator');
Route::GET('Manajement/Data-Testing/{id}/Detail', [DataTestingController::class, 'show'])->name('Manajement.DataTestings.show')->middleware('role_or_permission:Administrator|Melihat Detail Data Testing');
Route::GET('Manajement/Data-Testings/Create', [DataTestingController::class, 'create'])->name('Manajement.DataTestings.create')->middleware('role_or_permission:Administrator|Membuat Data Testing');
Route::POST('Manajement/Data-Testings', [DataTestingController::class, 'store'])->name('Manajement.DataTestings.store')->middleware('role:Administrator');
Route::GET('Manajement/Data-Testings/{id}/Edit', [DataTestingController::class, 'edit'])->name('Manajement.DataTestings.edit')->middleware('role_or_permission:Administrator|Mengupdate Data Testing');
Route::PATCH('Manajement/Data-Testing/{id}', [DataTestingController::class, 'update'])->name('Manajement.DataTestings.update')->middleware('role:Administrator');
Route::DELETE('Manajement/Data-Testing/{id}', [DataTestingController::class, 'destroy'])->name('Manajement.DataTestings.delete')->middleware('role_or_permission:Administrator|Menghapus Data Testing');

Route::GET('Manajement/User', [UserController::class, 'index'])->name('Manajement.Users.index')->middleware('role:Administrator');
Route::GET('Manajement/User/Create', [UserController::class, 'create'])->name('Manajement.Users.create')->middleware('role_or_permission:Administrator|Membuat Akun User Baru');
Route::GET('Manajement/User/{User:NIK}/Detail-User', [UserController::class, 'show'])->name('Manajement.Users.show')->middleware('role_or_permission:Administrator|Melihat Detail Akun User');
Route::POST('Manajement/User', [UserController::class, 'store'])->name('Manajement.Users.store')->middleware('role:Administrator');
Route::GET('Manajement/User/{user:NIK}/Edit', [UserController::class, 'edit'])->name('Manajement.Users.edit')->middleware('role_or_permission:Administrator|Mengupdate Akun User');
Route::PATCH('Manajement/User/{user:NIK}', [UserController::class, 'update'])->name('Manajement.Users.update')->middleware('role:Administrator');
Route::DELETE('Manajement/User/{user:NIK}', [UserController::class, 'destroy'])->name('Manajement.Users.delete')->middleware('role_or_permission:Administrator|Menghapus Akun User');

Route::GET('Manajement/Transaction', [TransactionDonorController::class, 'index'])->name('Manajement.Transaction.index')->middleware('role:Administrator|Petugas Medis');
Route::GET('Manajement/Transaction/{TransactionDonor:Code_Transaction}/Edit', [TransactionDonorController::class, 'edit'])->name('Manajement.Transaction.edit')->middleware('role_or_permission:Petugas Medis|Mengupdate Transaksi Donor');
Route::PATCH('Manajement/Transaction/{TransactionDonor:Code_Transaction}', [TransactionDonorController::class, 'update'])->name('Manajement.Transaction.update')->middleware('role_or_permission:Petugas Medis|Mengupdate Transaksi Donor');

Route::POST('/', [TransactionDonorController::class, 'store'])->name('Antrian.Mendonor');


Route::GET('Manajement/Hasil-Transaksi', [TransactionDonorController::class, 'GetResult_Transaction_Donor'])->name('Manajement.Hasil_Transaksi_Donor.index')->middleware('role:Administrator|Petugas Medis');
Route::GET('/Manajement/Hasil-Transaksi/{TransactionDonor:Code_Transaction}/Detail-Transaksi', [TransactionDonorController::class, 'GetDetail_Transaction_Donor'])->name('Manajement.Hasil_Transaksi_Donor.show')->middleware('role:Administrator|Petugas Medis');
Route::GET('/Manajement/Hasil-Transaksi/{TransactionDonor:Code_Transaction}/Printout', [TransactionDonorController::class, 'Printout'])->name('Manajement.Hasil_Transaksi_Donor.Printout');

