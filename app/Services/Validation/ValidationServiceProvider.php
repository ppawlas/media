<?php

namespace App\Services\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{

    /**
     * Register the service provided.
     */
    public function register()
    {
        // nothing to register
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app->validator->resolver(function ($translator, $data, $rules, $messages) {
            return new CustomValidation($translator, $data, $rules, $messages);
        });
    }

}