<?php

use App\Http\Controllers\DataTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionDonorController;
use App\Http\Controllers\UserController;
use App\Models\TransactionDonor;

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

Route::get('/test', [TransactionDonorController::class, 'getMeanHemoglobinResult_Layak'])->name('test.getMeanHemoglobinResult_Layak');
// Route::get('/unyu', [TransactionDonorController::class, 'update'])->name('test');