<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SupperAdmin\UsersController;
use App\Http\Controllers\User\LinksController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [Controller::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');
Route::get('/user/dashboard', [DashboardController::class, 'user_dashboard'])->name('user.dashboard');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

######################### End  users Routes  ########################
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/edit{user}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/store', [UsersController::class, 'store'])->name('users.store');
    Route::post('/update{user}', [UsersController::class, 'update'])->name('users.update');
    Route::get('/status{user}{status}', [UsersController::class, 'status'])->name('users.status');
    Route::get('/delete{user}', [UsersController::class, 'delete'])->name('users.delete');
});



Route::group(['prefix' => 'links'], function () {
    Route::get('/', [LinksController::class, 'index'])->name('links.index');
    Route::get('/create', [LinksController::class, 'create'])->name('links.create');
    Route::get('/edit{link}', [LinksController::class, 'edit'])->name('links.edit');
    Route::post('/store', [LinksController::class, 'store'])->name('links.store');
    Route::post('/update{link}', [LinksController::class, 'update'])->name('links.update');
    Route::get('/status{link}{status}', [LinksController::class, 'status'])->name('links.status');
    Route::get('/delete{link}', [LinksController::class, 'delete'])->name('links.delete');
});
