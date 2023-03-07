<?php

namespace App\Providers\User;

use App\Models\Branch;
use App\Models\CategoryHome;
use App\Models\Ceo;
use App\Models\Restaurant;
use App\Models\Skyline;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ComposerUserProvider extends ServiceProvider
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
        View::composer('user.layouts.footer', function ($view) {
            $name = Route::currentRouteName();
            $arr_route_food = array(  
                'user.food.home.index',
                'user.food.allProduct.index',
                'user.food.product.index',
                'user.food.product.show',
                'user.food.restaurant.index',
            );
            $url = [
                'logo' => asset('img/logo_shop.png'),
                'home' => route('user.home.index'),
                'name' => 'Sản phẩm',
                'categoryHome' => CategoryHome::where('service_id', 2)->get(),
                'allProduct' => route('user.allProduct.index'),
            ];
            if ( in_array($name,$arr_route_food) ) {
                $url = [
                    'logo' => asset('img/logo.png'),
                    'home' => route('user.food.home.index'),
                    'name' => 'Món ăn',
                    'categoryHome' => CategoryHome::where('service_id', 1)->get(),
                    'allProduct' => route('user.food.allProduct.index'),
                ];
            }
            $skyline = Skyline::first();
            return $view->with([
                'skyline' => $skyline,
                'url' => $url,
                'name' => $name,
            ]);
        });
        View::composer('user.layouts.header', function ($view) {
            $name = Route::currentRouteName();
            $arr_route_food = array(  
                'user.food.home.index',
                'user.food.allProduct.index',
                'user.food.product.index',
                'user.food.product.show',
                'user.food.restaurant.index',
            );
            $url = [
                'logo' => asset('img/logo_shop.png'),
                'home' => route('user.home.index'),
                'name' => 'Sản phẩm',
                'categoryHome' => CategoryHome::where('service_id', 2)->get(),
                'allProduct' => route('user.allProduct.index'),
                'product' => route('user.product.index'),
            ];
            if ( in_array($name,$arr_route_food) ) {
                $url = [
                    'logo' => asset('img/logo.png'),
                    'home' => route('user.food.home.index'),
                    'name' => 'Món ăn',
                    'categoryHome' => CategoryHome::where('service_id', 1)->get(),
                    'allProduct' => route('user.food.allProduct.index'),
                    'product' => route('user.food.product.index'),
                ];
            }
            return $view->with([
                'url' => $url,
                'name' => $name,
            ]);
        });
    }
}
