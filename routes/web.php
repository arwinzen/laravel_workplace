<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::any('/', [AuthController::class, 'login']);
    Route::any('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::any('/dashboard/users', [AdminController::class, 'displayUsers'])->name('display.users');
    Route::any('/dashboard/user/edit/{id}', [AdminController::class, 'editUsers'])->name('edit.user');
    Route::any('/dashboard/user/delete/{id}', [AdminController::class, 'delete'])->name('delete');
});
