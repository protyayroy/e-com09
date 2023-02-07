<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('customer.layouts.layout');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// <---------------------------------------------------------> //

//                  ALL ADMIN CONTROLLER                       //

// <---------------------------------------------------------> //

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

        // ADD/EDIT VENDOR PERSONAL/BANK/BUSINESS DETAILS
        Route::match(['post', 'get'], 'details/{details_type}', 'AdminController@addEditVendorDetails');

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

        // DELETE SECTION
        Route::get('delete-section/{id}', 'SectionController@destroy');

        // VIEW BRAND
        Route::get('brand', 'BrandController@brand');

        // CHANGE BRAND STATUS
        Route::post('brand-status', 'BrandController@updateBrandStatus');

        // ADD-EDIT BRAND
        Route::match(['post', 'get'], 'add-edit-brand/{id?}', 'BrandController@brandAddEdit');

        // DELETE BRAND
        Route::get('delete-brand/{id}', 'BrandController@destroy');

        // VIEW CATEGORY
        Route::get('category', 'CategoryController@category');

        // CHANGE CATEGORY STATUS
        Route::post('category-status', 'CategoryController@updateCategoryStatus');

        // ADD-EDIT CATEGORY
        Route::match(['post', 'get'], 'add-edit-category/{id?}', 'CategoryController@categoryAddEdit');

        // DELETE CATEGORY
        Route::get('delete-category/{id}', 'CategoryController@destroy');

        // CHANGE CATEGORY TYPE
        Route::get('change-category/{id}', 'CategoryController@changeCategoryType');

        // VIEW PRODUCT
        Route::get('product', 'ProductController@product');

        // CHANGE PRODUCT STATUS
        Route::post('product-status', 'ProductController@updateProductStatus');

        // ADD-EDIT PRODUCT
        Route::match(['post', 'get'], 'add-edit-product/{id?}', 'ProductController@productAddEdit');

        // DELETE PRODUCT
        Route::get('delete-product/{id}', 'ProductController@destroy');

        // VIEW PRODUCT ATTRIBUTE
        Route::get('product/{product_id}/product-attr', 'ProductAttributeController@productAttr');

        // ADD PRODUCT ATTRIBUTE
        Route::match(['post', 'get'], 'product/{product_id}/add-product-attr', 'ProductAttributeController@addAttribute');

        // EDIT PRODUCT ATTRIBUTE
        Route::post('edit-product-attr/{attr_id}', 'ProductAttributeController@editAttribute');

        // DELETE PRODUCT ATTRIBUTE
        Route::get('product/{product_id}/delete-product-attr/{attr_id}', 'ProductAttributeController@destroy');

        // VIEW PRODUCT GALLARY IMAGE
        Route::get('product/{product_id}/product-gallary', 'ProductImageController@gallary');

        // ADD PRODUCT GALLARY IMAGE
        Route::match(['post', 'get'], 'product/{product_id}/add-product-gallary', 'ProductImageController@addGallary');

        // EDIT PRODUCT GALLARY IMAGE
        Route::post('edit-product-gallary/{gallary_id}', 'ProductImageController@editGallary');

        // DELETE PRODUCT GALLARY IMAGE
        Route::get('product/{product_id}/delete-product-gallary/{gallary_id}', 'ProductImageController@destroy');

        // CHANGE CATEGORY TYPE
        // Route::get('change-category/{id}', 'CategoryController@changeCategoryType');

        // VIEW FILTER
        Route::get('filter', 'ProductsFilterController@filter');

        // CHANGE FILTER STATUS
        Route::post('filter-status', 'ProductsFilterController@updateFilterStatus');

        // ADD-EDIT FILTER
        Route::match(['post', 'get'], 'add-edit-filter/{id?}', 'ProductsFilterController@filterAddEdit');

        // DELETE FILTER
        Route::get('delete-filter/{id}', 'ProductsFilterController@destroy');

        // VIEW FILTER VALUES
        Route::get('filter-value', 'ProductsFiltersValueController@filterValue');

        // CHANGE FILTER VALUES STATUS
        Route::post('filter-value-status', 'ProductsFiltersValueController@updateFilterValueStatus');

        // ADD-EDIT FILTER VALUES
        Route::match(['post', 'get'], 'add-edit-filter-value/{id?}', 'ProductsFiltersValueController@filterValueAddEdit');

        // DELETE FILTER VALUES
        Route::get('delete-filter-value/{id}', 'ProductsFiltersValueController@destroy');


        Route::get('change_filter', 'ProductController@filter');


        // VIEW SLIDER BANNER
        Route::get('banner-management/slider', 'BannerController@slider');

        // ADD SLIDER BANNER
        Route::post('banner-management/slider/add-slider', 'BannerController@addSlider');

        // Edit SLIDER BANNER
        Route::post('banner-management/slider/edit-slider/{slider_id}', 'BannerController@updateSlider');

        // DELETE SLIDER BANNER
        Route::get('banner-management/delete-slider-image/{slider_id}', 'BannerController@destroy_slider');

        // VIEW SUB-BANNER
        Route::get('banner-management/sub-banner', 'BannerController@subBanner');

        // ADD SUB-BANNER
        Route::post('banner-management/sub-banner/add-sub_banner', 'BannerController@addSubBanner');

        // Edit SUB-BANNER
        Route::post('banner-management/sub-banner/edit-sub_banner/{subBanner_id}', 'BannerController@updateSubBanner');

        // DELETE SUB-BANNER
        Route::get('banner-management/delete-sub-banner/{subBanner_id}', 'BannerController@destroy_subBanner');
    });
});


// <---------------------------------------------------------> //

//                  ALL CUSTOMER CONTROLLER                    //

// <---------------------------------------------------------> //

Route::namespace("App\Http\Controllers\customer")->group(function () {

    // STARTNG PAGE
    Route::get("/", "IndexController@index");

    // STARTNG PAGE
    Route::get("new-arrival", "IndexController@newArrival");

    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');
    foreach ($catUrls as $key => $url) {
        //     echo '<pre>';
        // print_r($key);
        // die();
        // dd( $url);
        Route::match(['get', 'post'], "/" . $url, "IndexController@listing");
    };

    // SINGLE PRODUCT VIEW PAGE
    Route::match(['get', 'post'], "/single-product/{id}", "IndexController@singleProduct");

    // GET PRICE ACCODING TO CHANGING PRODUCT SIZE
    Route::get("/get_attr_price/{attr_id}", "IndexController@getPriceBySize");

    // ADD TO CART FROM SINGLE PRODUCT PAGE
    Route::post('/add-to-cart', "IndexController@addToCart");

    // VIEW CART PAGE
    Route::get("/cart", "CartController@cart");

    // UPDATE CART BY AJAX
    Route::post("/update-cart", "CartController@updateCart");

    // DELETE CART ITEM
    Route::get("/delete-cart-item/{id}", "CartController@delete");

    // VIEW USER LOGIN/REGISTRATION PAGE
    Route::get('user/login-registration', "UserAccount@viewPage");

    // USER REGISTRATION
    Route::post('user/registration', "UserAccount@registration");

    // USER ACCOUNT CONFORMATION
    Route::get('confirm/{code}', "UserAccount@confirm");

    // USER LOGIN
    Route::get('user/login', "UserAccount@login");

    // USER LOGOUT
    Route::get('user/logout', "UserAccount@logout");

    // VIEW checkout PAGE
    Route::get("/checkout", "CartController@checkout");




    // VIEW VENDOR LOGIN/REGISTRATION PAGE
    Route::get('vendor/login-registration', "VendorController@vendor");

    // VENDOR REGISTRATION
    Route::post('vendor/registration', "VendorController@registration");

    // VENDOR ACCOUNT CONFORMATION
    Route::get('vendor-confirm/{code}', "VendorController@confirm");

    // VENDOR LOGIN
    Route::get('vendor/login', "VendorController@login");

});
