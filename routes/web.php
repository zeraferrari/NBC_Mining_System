<?php

use App\Http\Controllers\DataTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
Route::patch('/User', [UserController::class, 'store'])->name('users.update');
Route::delete('/User/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/Data-Training', [DataTrainingController::class, 'index'])->name('datatraining.index');
