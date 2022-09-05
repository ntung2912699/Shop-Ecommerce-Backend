<?php

namespace App\Providers;

use App\Repositories\CartRepository\CartsRepositoryInterface;
use App\Repositories\CategoriesRepository\BrandsRepositoryInterface;
use App\Repositories\CategoriesRepository\PaymentRepository;
use App\Repositories\OrdersRepository\OrdersStatusRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\CartRepository\CartsRepositoryInterface::class,
            \App\Repositories\CartRepository\CartsRepository::class,
            \App\Repositories\CartRepository\CartsItemsRepositoryInterface::class,
            \App\Repositories\CartRepository\CartsItemsRepository::class,
            \App\Repositories\CartRepository\CartAttributeRepositoryInterface::class,
            \App\Repositories\CartRepository\CartAttributeRepository::class,

            \App\Repositories\CategoriesRepository\CategoriesRepositoryInterface::class,
            \App\Repositories\CategoriesRepository\CategoriesRepository::class,

            \App\Repositories\BrandsRepository\BrandsRepositoryInterface::class,
            \App\Repositories\BrandsRepository\BrandsRepository::class,

            \App\Repositories\OrdersRepository\OrdersStatusRepositoryInterface::class,
            \App\Repositories\OrdersRepository\OrdersStatusRepository::class,
            \App\Repositories\OrdersRepository\OrdersProductsRepositoryInterface::class,
            \App\Repositories\OrdersRepository\OrdersProductsRepository::class,
            \App\Repositories\OrdersRepository\OrdersRepositoryInterface::class,
            \App\Repositories\OrdersRepository\OrdersRepository::class,
            \App\Repositories\OrdersRepository\OrdersAttributeRepositoryInterface::class,
            \App\Repositories\OrdersRepository\OrdersAttributeRepository::class,

            \App\Repositories\PaymentRepository\PaymentInfoRepositoryInterface::class,
            \App\Repositories\PaymentRepository\PaymentInfoRepository::class,
            \App\Repositories\PaymentRepository\PaymentHistoryRepositoryInterface::class,
            \App\Repositories\PaymentRepository\PaymentHistoryRepository::class,
            \App\Repositories\PaymentRepository\PaymentMethodRepositoryInterface::class,
            \App\Repositories\PaymentRepository\PaymentMethodMethodRepository::class,

            \App\Repositories\ProductsRepository\AttributesRepositoryInterface::class,
            \App\Repositories\ProductsRepository\AttributesRepository::class,
            \App\Repositories\ProductsRepository\AttributeValueRepositoryInterface::class,
            \App\Repositories\ProductsRepository\AttributeValueRepository::class,
            \App\Repositories\ProductsRepository\ProductsRepositoryInterface::class,
            \App\Repositories\ProductsRepository\ProductsRepository::class,
            \App\Repositories\ProductsRepository\SpecsRepositoryInterface::class,
            \App\Repositories\ProductsRepository\SpecsRepository::class,

            \App\Repositories\ShipingRepository\ShipingMethodRepositoryInterface::class,
            \App\Repositories\ShipingRepository\ShipingMethodRepository::class,
            \App\Repositories\ShipingRepository\TransportersRepositoryInterface::class,
            \App\Repositories\ShipingRepository\TransportersRepository::class,

            \App\Repositories\UsersRepository\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository\UsersRepository::class,
            \App\Repositories\UsersRepository\UsersProfileRepositoryInterface::class,
            \App\Repositories\UsersRepository\UsersProfileRepository::class,
            \App\Repositories\UsersRepository\ShipingAddressRepositoryInterface::class,
            \App\Repositories\UsersRepository\ShipingAddressRepository::class,
            \App\Repositories\UsersRepository\WishlistRepositoryInterface::class,
            \App\Repositories\UsersRepository\WishlistRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
