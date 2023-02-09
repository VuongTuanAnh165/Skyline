<?php

namespace App\Providers\Restaurant;

use App\Http\Middleware\Restaurant\RedirectIfRestaurant;
use App\Http\Middleware\Restaurant\RedirectIfRestaurantAuthenticated;
use App\Http\Middleware\Restaurant\RedirectIfRestaurantPersonnel;
use App\Http\Middleware\Restaurant\RedirectIfRestaurantRestaurant;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RestaurantServiceProvider extends ServiceProvider
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
        $router->aliasMiddleware('restaurant_shop', RedirectIfRestaurantAuthenticated::class);
        $router->aliasMiddleware('restaurant_ceo', RedirectIfRestaurantRestaurant::class);
        $router->aliasMiddleware('restaurant_personnel', RedirectIfRestaurantPersonnel::class);
        $router->aliasMiddleware('restaurant', RedirectIfRestaurant::class);
    }
}
