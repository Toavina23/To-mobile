<?php

namespace App\Providers;

use App\Services\Api\ApiTrajetService;
use App\Services\TrajetService;
use Illuminate\Support\ServiceProvider;

class TrajetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TrajetService::class, function(){
            return new TrajetService();
        });
        $this->app->singleton(ApiTrajetService::class, function(){
            return new ApiTrajetService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
