<?php

namespace App\Providers\User;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ServiceUserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);
    }
}
