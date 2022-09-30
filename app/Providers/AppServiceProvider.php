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
            \App\Repositories\CategoriesRepository\CategoriesRepositoryInterface::class,
            \App\Repositories\CategoriesRepository\CategoriesRepository::class,

            \App\Repositories\ProductsRepository\AttributesRepositoryInterface::class,
            \App\Repositories\ProductsRepository\AttributesRepository::class,
            \App\Repositories\ProductsRepository\AttributeValueRepositoryInterface::class,
            \App\Repositories\ProductsRepository\AttributeValueRepository::class,
            \App\Repositories\ProductsRepository\ProductsRepositoryInterface::class,
            \App\Repositories\ProductsRepository\ProductsRepository::class,
            \App\Repositories\ProductsRepository\SpecsRepositoryInterface::class,
            \App\Repositories\ProductsRepository\SpecsRepository::class,

            \App\Repositories\UsersRepository\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository\UsersRepository::class,
            \App\Repositories\UsersRepository\UsersProfileRepositoryInterface::class,
            \App\Repositories\UsersRepository\UsersProfileRepository::class,
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
