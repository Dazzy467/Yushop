<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\home\HomeController;
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

Route::get('/', [HomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth:admin'])->name('Admindashboard');

Route::group(['middleware' => ['auth:admin']],function()
{
    Route::get('admin/dashboard',[AdminController::class,'index'])->name('Admindashboard');
    Route::get('admin/manageuser',[AdminController::class,'manageUser'])->name('admin.manageUser');
    Route::get('admin/manageproduct',[AdminController::class,'manageProduct'])->name('admin.manageProduct');

    // Create Edit delete
    Route::get('admin/manageuser/add',[AdminController::class,'addUser'])->name('admin.manageuser.add');
    Route::post('admin/manageuser/add',[AdminController::class,'storeUser'])->name('admin.manageuser.store');

    Route::get('admin/manageuser/{id}',[AdminController::class,'editUser']);
    Route::patch('admin/manageuser/{id}',[AdminController::class,'updateUser'])->name('admin.manageUser.update');
    Route::put('admin/manageuser/{id}',[AdminController::class,'updateUserPassword'])->name('admin.manageUser.password.update');
    Route::delete('admin/manageuser/{id}',[AdminController::class,'deleteUser'])->name('admin.manageUser.delete');

    // Barang
    Route::get('admin/manageproduct/add',[AdminController::class,'addProduct'])->name('admin.manageProduct.add');
    Route::post('admin/manageproduct/add',[AdminController::class,'storeProduct'])->name('admin.manageProduct.store');
    Route::get('admin/manageproduct/{id}',[AdminController::class,'editProduct']);
    Route::post('admin/manageproduct/{id}',[AdminController::class,'editImgProduct'])->name('admin.manageProduct.img.update');
    Route::patch('admin/manageproduct/{id}',[AdminController::class,'updateProduct'])->name('admin.manageProduct.update');
    Route::delete('admin/manageproduct/{id}',[AdminController::class,'deleteProduct'])->name('admin.manageProduct.delete');

});

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
