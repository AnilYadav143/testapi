<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;

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

Route::get('/',[AuthController::class,'registerForm']);
// Route::get('dashboard', [AuthController::class,'dashboard']);
Route::get('login',[AuthController::class,'Login'])->name('login');
Route::post('postlogin', [AuthController::class,'postlogin']);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'Dashboard'])->name('dashboard');

    Route::get('add_product',[AuthController::class,'AddProduct'])->name('add_product');
    Route::post('add_product',[AuthController::class,'AddProduct'])->name('save_product');
    Route::get('manage_product',[AuthController::class,'ManageProduct'])->name('manage_product');
    Route::post('pro_delete/{id}',[AuthController::class,'ProDelete'])->name('pro_delete');
    Route::get('pro_edit/{id}',[AuthController::class,'ProEdit'])->name('pro_edit');

    Route::get('add_category',[AuthController::class,'AddCategory'])->name('add_category');
    Route::post('add_category',[AuthController::class,'AddCategory'])->name('save_category');
    Route::post('cat_delete/{id}',[AuthController::class,'CatDelete'])->name('cat_delete');
    Route::get('cat_edit/{id}',[AuthController::class,'CatEdit'])->name('cat_edit');
    Route::put('update_category/{id}',[AuthController::class,'CatUpdate'])->name('update_category');

    // Roles and Permission
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::get('logout', [AuthController::class,'logout'])->name('logout');

    //Role Has Permission
    Route::get('role_has_permission',[RolePermissionController::class,'index'])->name('role_has_permission.index');
    Route::post('role_has_permission',[RolePermissionController::class,'create'])->name('role_has_permission.create');
    Route::post('assign_role_permission',[RolePermissionController::class,'store'])->name('assign_role_permission.store');

    Route::get('assignrole', [AuthController::class,'AssignRole'])->name('assignrole');
});


/******************** Frontend routes **********************/
Route::get('home',[FrontendController::class,'Index'])->name('indax');