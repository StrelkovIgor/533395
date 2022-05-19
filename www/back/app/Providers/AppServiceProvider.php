<?php

namespace App\Providers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ProductSqlRepository;
use App\Repositories\ShopSqlRepository;
use App\Repositories\UserSqlRepository;
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
        $this->app->bind(ProductRepositoryInterface::class, function ($app){
            return new ProductSqlRepository();
        });
        $this->app->bind(ShopRepositoryInterface::class, function ($app){
            return new ShopSqlRepository();
        });
        $this->app->bind(UserRepositoryInterface::class, function ($app){
            return new UserSqlRepository();
        });
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
