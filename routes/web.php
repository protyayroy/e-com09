<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function(){

    // LOGIN PAGE
    Route::match(['post','get'], 'login', 'AdminController@login');

    // ADMIN MIDDLEWARE START
    Route::group(['middleware' => ['admin']],function(){

        // VIEW DASHBOARD
        Route::get('dashboard', 'AdminController@dashboard');

        // CHANGE PASSWORD
        Route::match(['post','get'], 'change-password', 'AdminController@changeAdminPassword');

        // UPDATE ADMIN PROFILE
        Route::match(['post','get'], 'update-profile', 'AdminController@updateAdminProfile');

        // VIEW DASHBOARD
        Route::get('admin-management/{type}', 'AdminController@adminManagement');
    });
});
