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
});
Route::group([
    'middleware' => 'auth.jwt',
],
function ($router) {
    /**
     * group route for categories
     */
    Route::get('/get-list-product/by-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'get_list_product_by_categories']);
    Route::get('/get-categories', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'index']);
    Route::post('/create-categories', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'store']);
    Route::get('/show-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'show']);
    Route::post('/update-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'update']);
    Route::delete('/destroy-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'destroy']);
    Route::get('/search-categories', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'search_category']);

    /**
     * group route for brands
     */
    Route::get('/get-brands', [\App\Http\Controllers\API\Brands\BrandsController::class, 'index']);
    Route::get('/get-brands/{id}', [\App\Http\Controllers\API\Brands\BrandsController::class, 'show']);
    Route::post('/create-brands', [\App\Http\Controllers\API\Brands\BrandsController::class, 'store']);
    Route::post('/update-brands/{id}', [\App\Http\Controllers\API\Brands\BrandsController::class, 'update']);
    Route::delete('/destroy-brands/{id}', [\App\Http\Controllers\API\Brands\BrandsController::class, 'destroy']);

    /**
     * group route for product
     */
    Route::get('/get-products', [\App\Http\Controllers\API\Products\ProductsController::class, 'index']);
    Route::post('/create-products', [\App\Http\Controllers\API\Products\ProductsController::class, 'store']);
    Route::post('/update-products/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'update']);
    Route::get('/show-products/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'show']);
    Route::delete('/destroy-products/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'destroy']);
    Route::get('/get-group-attribute/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_attribute']);

    /**
     * group route for attribute
     */
    Route::get('/get-attribute', [\App\Http\Controllers\API\Products\AttributeController::class, 'index']);
    Route::get('/get-attribute/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'show']);
    Route::post('/create-attribute', [\App\Http\Controllers\API\Products\AttributeController::class, 'store']);
    Route::delete('/destroy-attribute/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'destroy']);

    Route::get('/get-attribute-value', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'index']);
    Route::post('/create-attribute-value', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'store']);
    Route::delete('/destroy-attribute-value/{id}', [\App\Http\Controllers\API\Products\AttributeValueController::class, 'destroy']);

    /**
     * group route for cart
     */
    Route::get('/get-cart', [\App\Http\Controllers\API\Carts\CartsController::class, 'index']);
    Route::get('/get-cart-user/{id}', [\App\Http\Controllers\API\Carts\CartsController::class, 'show']);
    Route::post('/create-cart', [\App\Http\Controllers\API\Carts\CartsController::class, 'store']);
    Route::post('/update-cart', [\App\Http\Controllers\API\Carts\CartsController::class, 'update']);
    Route::delete('/destroy-cart/{id}', [\App\Http\Controllers\API\Carts\CartsController::class, 'destroy']);
    Route::get('/get-cart-by-user/{id}', [\App\Http\Controllers\API\Carts\CartsController::class, 'get_cart_by_user_id']);
    Route::delete('/remove-items-cart/{id}', [\App\Http\Controllers\API\Carts\CartsController::class, 'remove_item_cart']);
    Route::post('/update-qty-cart/{id}', [\App\Http\Controllers\API\Carts\CartsController::class, 'update_qty_item_cart']);
    /**
     * group route for users profile
     */
    Route::get('/get-profile', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'index']);
    Route::get('/get-profile-user/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'show']);
    Route::post('/create-profile', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'store']);
    Route::post('/update-profile/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'update']);
    Route::delete('/destroy-profile/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'destroy']);
    Route::get('/get-profile-by-user/{id}', [\App\Http\Controllers\API\Users\UsersProfilesController::class, 'get_profile_by_user']);


    /**
     * group route for shipping address
     */
    Route::get('/get-address', [\App\Http\Controllers\API\Users\ShipingAddressController::class, 'index']);
    Route::get('/get-address-user/{id}', [\App\Http\Controllers\API\Users\ShipingAddressController::class, 'show']);
    Route::post('/create-address', [\App\Http\Controllers\API\Users\ShipingAddressController::class, 'store']);
    Route::post('/update-address/{id}', [\App\Http\Controllers\API\Users\ShipingAddressController::class, 'update']);
    Route::delete('/destroy-address/{id}', [\App\Http\Controllers\API\Users\ShipingAddressController::class, 'destroy']);

    /**
     * group route for shipping transporters
     */
    Route::get('/get-transporters', [\App\Http\Controllers\API\Shipings\TransportersController::class, 'index']);
    Route::get('/get-transporters/{id}', [\App\Http\Controllers\API\Shipings\TransportersController::class, 'show']);
    Route::post('/create-transporters', [\App\Http\Controllers\API\Shipings\TransportersController::class, 'store']);
    Route::post('/update-transporters/{id}', [\App\Http\Controllers\API\Shipings\TransportersController::class, 'update']);
    Route::delete('/destroy-transporters/{id}', [\App\Http\Controllers\API\Shipings\TransportersController::class, 'destroy']);

    /**
     * group route for shipping method
     */
    Route::get('/get-shiping-method', [\App\Http\Controllers\API\Shipings\ShipingMethodController::class, 'index']);
    Route::get('/get-shiping-method/{id}', [\App\Http\Controllers\API\Shipings\ShipingMethodController::class, 'show']);
    Route::post('/create-shiping-method', [\App\Http\Controllers\API\Shipings\ShipingMethodController::class, 'store']);
    Route::post('/update-shiping-method/{id}', [\App\Http\Controllers\API\Shipings\ShipingMethodController::class, 'update']);
    Route::delete('/destroy-shiping-method/{id}', [\App\Http\Controllers\API\Shipings\ShipingMethodController::class, 'destroy']);

    /**
     * group route for payment method
     */
    Route::get('/get-payment-method', [\App\Http\Controllers\API\Payments\PaymentMethodsController::class, 'index']);
    Route::get('/get-payment-method/{id}', [\App\Http\Controllers\API\Payments\PaymentMethodsController::class, 'show']);
    Route::post('/create-payment-method', [\App\Http\Controllers\API\Payments\PaymentMethodsController::class, 'store']);
    Route::post('/update-payment-method/{id}', [\App\Http\Controllers\API\Payments\PaymentMethodsController::class, 'update']);
    Route::delete('/destroy-payment-method/{id}', [\App\Http\Controllers\API\Payments\PaymentMethodsController::class, 'destroy']);

    /**
     * group route for order status
     */
    Route::get('/get-status', [\App\Http\Controllers\API\Orders\OrdersStatusController::class, 'index']);
    Route::get('/get-status/{id}', [\App\Http\Controllers\API\Orders\OrdersStatusController::class, 'show']);
    Route::post('/create-status', [\App\Http\Controllers\API\Orders\OrdersStatusController::class, 'store']);
    Route::post('/update-status/{id}', [\App\Http\Controllers\API\Orders\OrdersStatusController::class, 'update']);
    Route::delete('/destroy-status/{id}', [\App\Http\Controllers\API\Orders\OrdersStatusController::class, 'destroy']);

    /**
     * group route for order
     */
    Route::get('/get-order', [\App\Http\Controllers\API\Orders\OrdersController::class, 'index']);
    Route::get('/get-order-user/{id}', [\App\Http\Controllers\API\Orders\OrdersController::class, 'show']);
    Route::post('/create-order', [\App\Http\Controllers\API\Orders\OrdersController::class, 'store']);
    Route::post('/update-order/{id}', [\App\Http\Controllers\API\Orders\OrdersController::class, 'update']);
    Route::delete('/destroy-order/{id}', [\App\Http\Controllers\API\Orders\OrdersController::class, 'destroy']);
    Route::post('/update-order-status/{id}', [\App\Http\Controllers\API\Orders\OrdersController::class, 'update_status_order']);

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
Route::get('/get-product-clients', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_new_products_for_home_page']);
Route::get('/get-group-attribute-client/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_attribute']);
Route::get('/show-products-client/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'show']);
Route::get('/get-group-attribute/{id}', [\App\Http\Controllers\API\Products\ProductsController::class, 'get_attribute']);
Route::get('/get-attribute/{id}', [\App\Http\Controllers\API\Products\AttributeController::class, 'show']);
Route::post('/search-products', [\App\Http\Controllers\API\Products\ProductsController::class, 'search_products']);
Route::get('/get-list-product/by-categories/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'get_list_product_by_categories']);
Route::get('/show-category/{id}', [\App\Http\Controllers\API\Categories\CategoriesController::class, 'show']);
