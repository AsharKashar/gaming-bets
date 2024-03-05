<?php

namespace App\Providers;

use App\Service\MatchService;
use Illuminate\Support\ServiceProvider;

class MatchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\MatchService', function ($app) {
            return new MatchService();
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
