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

require __DIR__ . '/auth.php';


Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function () {

    // LOGIN PAGE
    Route::match(['post', 'get'], 'login', 'AdminController@login');

    // ADMIN MIDDLEWARE START
    Route::group(['middleware' => ['admin']], function () {

        // ADMIN LOGOUT
        Route::get('logout', 'AdminController@logout');

        // VIEW DASHBOARD
        Route::get('dashboard', 'AdminController@dashboard');

        // CHANGE PASSWORD
        Route::match(['post', 'get'], 'change-password', 'AdminController@changeAdminPassword');

        // REAL TIME CHECK ADMIN PASSWORD
        Route::post('check-password', 'AdminController@checkAdminPassword');

        // UPDATE ADMIN PROFILE
        Route::match(['post', 'get'], 'update-profile', 'AdminController@updateAdminProfile');

        // VIEW ADMIN DETAILS
        Route::get('admin-management/{type}', 'AdminController@adminManagement');

        // VIEW VENDOR DETAILS
        Route::get('vendor-details/{id}', 'AdminController@viewVendorDetails');

        // CHANGE ADMIN STATUS
        Route::post('admin-management/admin-status', 'AdminController@updateAdminStatus');

        // VIEW SECTION
        Route::get('section', 'SectionController@section');

        // CHANGE SECTION STATUS
        Route::post('section-status', 'SectionController@updateSectionStatus');

        // ADD-EDIT SECTION
        Route::match(['post', 'get'], 'add-edit-section/{id?}', 'SectionController@sectionAddEdit');

        // DELETE BRAND
        Route::get('delete-section/{id}', 'SectionController@destroy');

        // VIEW BRAND
        Route::get('brand', 'BrandController@brand');

        // CHANGE BRAND STATUS
        Route::post('brand-status', 'BrandController@updateBrandStatus');

        // ADD-EDIT BRAND
        Route::match(['post', 'get'], 'add-edit-brand/{id?}', 'BrandController@brandAddEdit');

        // DELETE BRAND
        Route::get('delete-brand/{id}', 'BrandController@destroy');

    });
});
