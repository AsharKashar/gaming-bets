<?php

namespace App\Providers;

use App\Service\BracketService;
use Illuminate\Support\ServiceProvider;

class BracketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\BracketService', function ($app) {
            return new BracketService();
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
