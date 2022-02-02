<?php

use App\Http\Controllers\DataTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
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
Route::GET('/Role/{id}/Edit', [RoleController::class, 'edit'])->name('role.edit');
Route::PATCH('/Role/{id}', [RoleController::class, 'update'])->name('role.update');
Route::DELETE('/Role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

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

Route::get('/Data-Training', [DataTrainingController::class, 'index'])->name('datatraining.index');


Route::get('/Permission', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/Permission/Create', [PermissionController::class, 'create'])->name('permission.create');
Route::POST('/Permission', [PermissionController::class, 'store'])->name('permission.store');
Route::GET('/Permission/{id}/Edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::PATCH('/Permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
Route::delete('/Permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

Route::get('/test', [UserController::class, 'test'])->name('test');

