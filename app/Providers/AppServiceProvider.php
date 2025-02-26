<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Queue\Connectors\ZeroMqConnector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['queue']->extend('zeromq', function () {
            return new ZeroMqConnector;
        });
    }
}
