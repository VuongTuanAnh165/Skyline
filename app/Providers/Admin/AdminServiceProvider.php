<?php

namespace App\Providers\Admin;

use App\Http\Middleware\Admin\RedirectIfAdminAuthenticated;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
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
        $router->aliasMiddleware('admin', RedirectIfAdminAuthenticated::class);
    }
}
