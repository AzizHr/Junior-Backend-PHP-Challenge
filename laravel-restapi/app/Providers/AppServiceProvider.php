<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Impl\CategoryRepositoryImpl;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Impl\ProductRepositoryImpl;
use App\Repositories\ProductCategoryRepositoryInterface;
use App\Repositories\Impl\ProductCategoryRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepositoryImpl::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryImpl::class);
        $this->app->bind(ProductCategoryRepositoryInterface::class, ProductCategoryRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
