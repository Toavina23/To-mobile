<?php

namespace App\Providers;

use App\Services\VehiculeService;
use Illuminate\Support\ServiceProvider;

class VehiculeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VehiculeService::class, function(){
            return new VehiculeService();
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
