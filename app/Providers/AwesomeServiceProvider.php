<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AwesomeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // bind interface
        $this->app->bind("App\Service\AwesomeServiceInterface", "App\Service\AwesomeService");
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
