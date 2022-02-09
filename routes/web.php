<?php

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
//     return view('welcome');
// });

Auth::routes();

Route::GET('/Role', [RoleController::class, 'index'])->name('Manajement.Roles.index');
Route::GET('/Role/Create', [RoleController::class, 'create'])->name('Manajement.Roles.create');
Route::POST('/Role', [RoleController::class, 'store'])->name('Manajement.Roles.store');
Route::GET('/Role/{id}/Edit', [RoleController::class, 'edit'])->name('Manajement.Roles.edit');
Route::PATCH('/Role/{id}', [RoleController::class, 'update'])->name('Manajement.Roles.update');
Route::DELETE('/Role/{id}', [RoleController::class, 'destroy'])->name('Manajement.Roles.delete');

Route::GET('/Permission', [PermissionController::class, 'index'])->name('Manajement.Permissions.index');
Route::GET('/Permission/Create', [PermissionController::class, 'create'])->name('Manajement.Permissions.create');
Route::POST('/Permission', [PermissionController::class, 'store'])->name('Manajement.Permissions.store');
Route::GET('/Permission/{id}/Edit', [PermissionController::class, 'edit'])->name('Manajement.Permissions.edit');
Route::PATCH('/Permission/{id}', [PermissionController::class, 'update'])->name('Manajement.Permissions.update');
Route::DELETE('/Permission/{id}', [PermissionController::class, 'destroy'])->name('Manajement.Permissions.delete');

Route::GET('/Rhesus-Categories', [RhesusCategoryController::class, 'index'])->name('Manajement.Rhesus.index');
Route::GET('/Rhesus-Categories/Create', [RhesusCategoryController::class, 'create'])->name('Manajement.Rhesus.create');
Route::POST('/Rhesus-Categories', [RhesusCategoryController::class, 'store'])->name('Manajement.Rhesus.store');
Route::GET('/Rhesus-Categories/{id}/Edit', [RhesusCategoryController::class, 'edit'])->name('Manajement.Rhesus.edit');
Route::PATCH('/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'update'])->name('Manajement.Rhesus.update');
Route::DELETE('/Rhesus-Categories/{id}', [RhesusCategoryController::class, 'destroy'])->name('Manajement.Rhesus.delete');

Route::GET('/Data-Trainings', [DataTrainingController::class, 'index'])->name('Manajement.DataTrainings.index');
Route::GET('/Data-Trainings/Create', [DataTrainingController::class, 'create'])->name('Manajement.DataTrainings.create');
Route::POST('/Data-Trainings', [DataTrainingController::class, 'store'])->name('Manajement.DataTrainings.store');
Route::GET('/Data-Trainings/{id}/Edit', [DataTrainingController::class, 'edit'])->name('Manajement.DataTrainings.edit');
Route::PATCH('/Data-Trainings/{id}', [DataTrainingController::class, 'update'])->name('Manajement.DataTrainings.update');
Route::DELETE('/Data-Trainings/{id}', [DataTrainingController::class, 'destroy'])->name('Manajement.DataTrainings.delete');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/User', [UserController::class, 'index'])->name('users.index');
Route::get('/User/Create', [UserController::class, 'create'])->name('users.create');
Route::POST('/User', [UserController::class, 'store'])->name('users.store');
Route::get('/User/Edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/User/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/User/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::GET('/Transaction', [TransactionDonorController::class, 'index'])->name('transaction.index');
Route::POST('/Transaction', [TransactionDonorController::class, 'store'])->name('transaction.store');
Route::get('/Transaction/{id}/Edit', [TransactionDonorController::class, 'edit'])->name('transaction.edit');
Route::PATCH('/Transaction/{id}', [TransactionDonorController::class, 'update'])->name('transactions.update');





Route::get('/test', [UserController::class, 'test'])->name('test');

