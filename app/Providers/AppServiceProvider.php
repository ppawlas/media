<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // set the observers
        \App\WaterReading::observe(\App\Observers\WaterReadingObserver::class);
        \App\GasReading::observe(\App\Observers\GasReadingObserver::class);
        \App\GasInvoice::observe(\App\Observers\GasInvoiceObserver::class);
        \App\ElectricityReading::observe(\App\Observers\ElectricityReadingObserver::class);
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
