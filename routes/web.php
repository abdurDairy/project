<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
    // dd(auth()->user()->getRoleNames()->first());
    return view('dashboard');
})->middleware(['auth', 'verified', 'IsUser'])->name('dashboard');

/**
 * ADMIN 
 * 
 */
Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'isAdmin'])->name('admin.index');


/**
 * 
 * ROLE PLATE
 * 
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'roles'])->name('roles.index');
    Route::get('/role-path', [RoleController::class, 'pathRoles'])->name('path.role');
    Route::post('/insert-roles', [RoleController::class, 'insertRoles'])->name('insert.role');

    Route::get('/permission-path', [PermissionController::class, 'pathPermission'])->name('path.permission');
    Route::post('/permission-insert', [PermissionController::class, 'insertPermission'])->name('insert.permission');
    Route::get('/permissions', [PermissionController::class, 'permissions'])->name('permissions.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';