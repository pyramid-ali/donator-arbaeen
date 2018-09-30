<?php

namespace App\Providers;

use App\Arbaeen\Services\ClientWrapper;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{

    protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Client', function($app) {
            return new ClientWrapper;
        });
    }

    public function provides()
    {
        return [
            'Client'
        ];
    }
}
