<?php

namespace App\Providers;

use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Repositories\Lot\LotRepositoryInterface;
use App\Http\Repositories\Lot\LotsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind( CategoryRepositoryInterface::class, CategoryRepository::class );
        $this->app->bind( LotRepositoryInterface::class, LotsRepository::class );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
