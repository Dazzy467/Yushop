<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('Admindashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', [AdminProfileController::class, 'edit'])->name('adminprofile.edit');
    Route::patch('admin/profile', [AdminProfileController::class, 'update'])->name('adminprofile.update');
    Route::delete('admin/profile', [AdminProfileController::class, 'destroy'])->name('adminprofile.destroy');
});
require __DIR__.'/auth.php';
