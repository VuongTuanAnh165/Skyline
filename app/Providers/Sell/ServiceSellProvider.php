<?php

namespace App\Providers\Sell;

use App\Http\Middleware\Sell\RedirectIfSellAuthenticated;
use App\Http\Middleware\Sell\RedirectIfSellBranchAuth;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ServiceSellProvider extends ServiceProvider
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
        $router->aliasMiddleware('sell', RedirectIfSellAuthenticated::class);
        $router->aliasMiddleware('check_branch', RedirectIfSellBranchAuth::class);
    }
}
