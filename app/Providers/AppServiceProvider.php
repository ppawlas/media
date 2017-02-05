<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Router $router
     */
    public function boot(Router $router)
    {
        // set the observers
        \App\WaterReading::observe(\App\Observers\WaterReadingObserver::class);
        \App\GasReading::observe(\App\Observers\GasReadingObserver::class);
        \App\GasInvoice::observe(\App\Observers\GasInvoiceObserver::class);
        \App\ElectricityReading::observe(\App\Observers\ElectricityReadingObserver::class);

        // set the cors middleware in local environment
        if ($this->app->environment() === 'local') {
            $router->pushMiddlewareToGroup('api', \Barryvdh\Cors\HandleCors::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
