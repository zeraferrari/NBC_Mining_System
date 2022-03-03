<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RhesusCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionDonorController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::GET('Manajement/Dashboard', [Dashboard::class, 'index'])->name('Manajement.Dashboard.index');

Route::GET('Manajement/Role', [RoleController::class, 'index'])->name('Manajement.Roles.index');
Route::GET('Manajement/Role/Create', [RoleController::class, 'create'])->name('Manajement.Roles.create');
Route::POST('Manajement/Role', [RoleController::class, 'store'])->name('Manajement.Roles.store');
Route::GET('Manajement/Role/{id}/Edit', [RoleController::class, 'edit'])->name('Manajement.Roles.edit');
Route::PATCH('Manajement/Role/{id}', [RoleController::class, 'update'])->name('Manajement.Roles.update');
Route::DELETE('Manajement/Role/{id}', [RoleController::class, 'destroy'])->name('Manajement.Roles.delete');

Route::GET('Manajement/Permission', [PermissionController::class, 'index'])->name('Manajement.Permissions.index');
Route::GET('Manajement/Permission/Create', [PermissionController::class, 'create'])->name('Manajement.Permissions.create');
Route::POST('Manajement/Permission', [PermissionController::class, 'store'])->name('Manajement.Permissions.store');
Route::GET('Manajement/Permission/{id}/Edit', [PermissionController::class, 'edit'])->name('Manajement.Permissions.edit');
Route::PATCH('Manajement/Permission/{id}', [PermissionController::class, 'update'])->name('Manajement.Permissions.update');
Route::DELETE('Manajement/Permission/{id}', [PermissionController::class, 'destroy'])->name('Manajement.Permissions.delete');

Route::GET('Manajement/Rhesus-Categories', [RhesusCategoryController::class, 'index'])->name('Manajement.Rhesus.index');
Route::GET('Manajement/Rhesus-Categories/Create', [RhesusCategoryController::class, 'create'])->name('Manajement.Rhesus.create');
Route::POST('Manajement/Rhesus-Categories', [RhesusCategoryController::class, 'store'])->name('Manajement.Rhesus.store');
Route::GET('Manajement/Rhesus-Categories/{id}/Edit', [RhesusCategoryController::class, 'edit'])->name('Manajement.Rhesus.edit');
Route::PATCH('Manajement/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'update'])->name('Manajement.Rhesus.update');
Route::DELETE('Manajement/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'destroy'])->name('Manajement.Rhesus.delete');

Route::GET('Manajement/Data-Trainings', [DataTrainingController::class, 'index'])->name('Manajement.DataTrainings.index');
Route::GET('Manajement/Data-Trainings/Create', [DataTrainingController::class, 'create'])->name('Manajement.DataTrainings.create');
Route::POST('Manajement/Data-Trainings', [DataTrainingController::class, 'store'])->name('Manajement.DataTrainings.store');
Route::GET('Manajement/Data-Trainings/{id}/Edit', [DataTrainingController::class, 'edit'])->name('Manajement.DataTrainings.edit');
Route::PATCH('Manajement/Data-Trainings/{id}', [DataTrainingController::class, 'update'])->name('Manajement.DataTrainings.update');
Route::DELETE('Manajement/Data-Trainings/{id}', [DataTrainingController::class, 'destroy'])->name('Manajement.DataTrainings.delete');

Route::GET('Manajement/User', [UserController::class, 'index'])->name('Manajement.Users.index');
Route::GET('Manajement/User/Create', [UserController::class, 'create'])->name('Manajement.Users.create');
Route::GET('Manajement/User/{id}/Detail-User', [UserController::class, 'show'])->name('Manajement.Users.show');
Route::POST('Manajement/User', [UserController::class, 'store'])->name('Manajement.Users.store');
Route::GET('Manajement/User/{user:NIK}/Edit', [UserController::class, 'edit'])->name('Manajement.Users.edit');
Route::PATCH('Manajement/User/{id}', [UserController::class, 'update'])->name('Manajement.Users.update');
Route::DELETE('Manajement/User/{id}', [UserController::class, 'destroy'])->name('Manajement.Users.delete');

Route::GET('Manajement/Transaction', [TransactionDonorController::class, 'index'])->name('Manajement.Transaction.index');
Route::GET('Manajement/Transaction/{id}/Edit', [TransactionDonorController::class, 'edit'])->name('Manajement.Transaction.edit');
Route::PATCH('Manajement/Transaction/{id}', [TransactionDonorController::class, 'update'])->name('Manajement.Transaction.update');

Route::POST('/', [TransactionDonorController::class, 'store'])->name('Antrian.Mendonor');


Route::GET('Manajement/Hasil-Transaksi', [TransactionDonorController::class, 'GetResult_Transaction_Donor'])->name('Manajement.Hasil_Transaksi_Donor.index');
Route::GET('/Manajement/Hasil-Transaksi/{TransactionDonor:Code_Transaction}/show', [TransactionDonorController::class, 'GetDetail_Transaction_Donor'])->name('Manajement.Hasil_Transaksi_Donor.show');



