<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [\App\Http\Controllers\API\Auth\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\API\Auth\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\API\Auth\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\API\Auth\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\API\Auth\AuthController::class, 'profile']);
    Route::post('/check-admin-permission', [\App\Http\Controllers\API\Auth\AuthController::class, 'checkAdminPermission']);
    Route::post('/change-password', [\App\Http\Controllers\API\Auth\AuthController::class, 'changePassword']);
});
Route::post('/forgot-password', [\App\Http\Controllers\API\Users\UsersController::class, 'forgotPassword']);

Route::group([
    'middleware' => 'auth.admin',
    'prefix' => 'admin'
],
function ($router) {
    Route::get('/get-categories-admin', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'index']);
    Route::get('/show-categories-admin/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'show']);
    Route::post('/update-categories-admin/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'update']);
    Route::delete('/destroy-categories-admin/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'destroy']);
    Route::post('/create-categories-admin', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'store']);

    Route::get('/get-attribute-admin/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'show']);
    Route::post('/create-attribute-admin', [\App\Http\Controllers\API\Products\AttributeController::class, 'store']);
    Route::get('/get-list-attributes-admin', [\App\Http\Controllers\API\Products\AttributeController::class, 'index']);
    Route::post('/update-attributes-admin/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'update']);
    Route::delete('/destroy-attribute-admin/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'destroy']);

    Route::post('/create-attribute-value-admin', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'store']);
    Route::delete('/destroy-attribute-value-admin/{id}', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'destroy']);
    Route::post('/update-attribute-value-admin/{id}', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'update']);

    Route::get('/show-products-admin/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'show']);
    Route::get('/get-all-products-admin', [\App\Http\Controllers\API\Products\ProductsController::class, 'index']);
    Route::post('/create-products-admin', [\App\Http\Controllers\API\Products\ProductsController::class, 'store']);
    Route::post('/update-products-admin/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'update']);
    Route::delete('/destroy-products-admin/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'destroy']);

    Route::get('/get-users-admin', [\App\Http\Controllers\API\Users\UsersController::class, 'index']);
    Route::post('/update-users-role-admin/{id}', [\App\Http\Controllers\API\Users\UsersController::class, 'update']);

    Route::post('/check-admin', [\App\Http\Controllers\API\Auth\AuthController::class, 'checkAdminPermission']);

    Route::get('/dashboard-product', [\App\Http\Controllers\API\Products\ProductsController::class, 'produts_statis']);
    Route::get('/dashboard-categories', [\App\Http\Controllers\API\Products\ProductsController::class, 'categories_statis']);
    Route::get('/dashboard-users', [\App\Http\Controllers\API\Products\ProductsController::class, 'users_statis']);
    Route::get('/dashboard-money', [\App\Http\Controllers\API\Products\ProductsController::class, 'money_statis']);

    /**
     * group route for users profile
     */
    Route::get('/get-profile', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'index']);
    Route::get('/get-profile-user/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'show']);
    Route::post('/create-profile', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'store']);
    Route::post('/update-profile/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'update']);
    Route::delete('/destroy-profile/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'destroy']);
    Route::get('/get-profile-by-user/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'get_profile_by_user']);
    Route::get('/get-address-by-user/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'get_address_by_user']);

    /**
     * group route for specs
     */
    Route::get('/get-specs', [\App\Http\Controllers\API\Products\SpecsController::class, 'index']);
    Route::get('/get-specs/{id}', [\App\Http\Controllers\API\Products\SpecsController::class, 'show']);
    Route::post('/create-specs', [\App\Http\Controllers\API\Products\SpecsController::class, 'store']);
    Route::post('/update-specs/{id}', [\App\Http\Controllers\API\Products\SpecsController::class, 'update']);
    Route::delete('/destroy-specs/{id}', [\App\Http\Controllers\API\Products\SpecsController::class, 'destroy']);

    /**
     * group route for wishlist
     */
    Route::get('/get-wishlist', [\App\Http\Controllers\API\Users\WishlistController::class, 'index']);
    Route::get('/get-wishlist/{id}', [\App\Http\Controllers\API\Users\WishlistController::class, 'show']);
    Route::post('/create-wishlist', [\App\Http\Controllers\API\Users\WishlistController::class, 'store']);
    Route::post('/update-wishlist/{id}', [\App\Http\Controllers\API\Users\WishlistController::class, 'update']);
    Route::delete('/destroy-wishlist/{id}', [\App\Http\Controllers\API\Users\WishlistController::class, 'destroy']);
});

Route::get('/get-categories-client', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'index']);
Route::get('/get-all-products', [\App\Http\Controllers\API\Products\ProductsController::class, 'index']);
Route::get('/get-product-clients', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_new_products_for_home_page']);
Route::get('/get-product-shop', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_new_products_for_shop']);
Route::get('/get-group-attribute-client/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_attribute']);
Route::get('/show-products-client/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'show']);
Route::get('/get-group-attribute/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_attribute']);
Route::get('/get-attribute/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'show']);
Route::post('/search-products', [\App\Http\Controllers\API\Products\ProductsController::class, 'search_products']);
Route::get('/get-list-product/by-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'get_list_product_by_categories']);
Route::get('/show-category/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'show']);
Route::post('/filter-product', [\App\Http\Controllers\API\Products\ProductsController::class, 'filter_products']);
Route::post('/create-account-admin', [\App\Http\Controllers\API\Users\UsersController::class, 'create_account_admin']);


