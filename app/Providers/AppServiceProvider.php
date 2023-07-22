<?php

namespace App\Providers;

use App\Actions\JobSeeker\StoreAction;
use App\Http\Controllers\JobSeeker\StoreController;
use App\Interfaces\StoreInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(StoreController::class)
            ->needs(StoreInterface::class)
            ->give(function () {
                return new StoreAction();
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
