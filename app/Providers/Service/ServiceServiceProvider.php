<?php

namespace App\Providers\Service;

use App\Http\Middleware\Ceo\RedirectIfCeoAuthenticated;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $router->aliasMiddleware('ceo', RedirectIfCeoAuthenticated::class);
    }
}
