<?php

namespace App\Providers\User;

use App\Http\Middleware\User\RedirectIfUserAuthenticated;
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
        $router->aliasMiddleware('user', RedirectIfUserAuthenticated::class);
    }
}
