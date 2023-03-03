<?php

namespace App\Providers\Restaurant;

use App\Models\Admin;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\ServiceType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('restaurant.admin.layouts.aside', function ($view) {
            $restaurant = Auth::guard('restaurant')->user();
            $personnel = Auth::guard('personnel')->user();
            $restaurant_id = Auth::guard('restaurant')->check() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $data_restaurant = Restaurant::query()
                ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
                ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
                ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
                ->where('service_types.service_id', 1)
                ->where('restaurants.id', $restaurant_id)
                ->first();
            $data_shop = Restaurant::query()
                ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
                ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
                ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
                ->where('service_types.service_id', 2)
                ->where('restaurants.id', $restaurant_id)
                ->first();
            return $view->with([
                'restaurant' => $restaurant,
                'personnel' => $personnel,
                'data_restaurant' => $data_restaurant,
                'data_shop' => $data_shop,
            ]);
        });
        View::composer('restaurant.admin.layouts.master', function ($view) {
            $restaurant = Auth::guard('restaurant')->check() ? Auth::guard('restaurant')->user() : Restaurant::find(Auth::guard('personnel')->user()->restaurant_id);
            $logo_web = !empty($restaurant->logo) ? $restaurant->logo : '';
            return $view->with([
                'logo_web' => $logo_web,
            ]);
        });
        View::composer('restaurant.admin.dish.aside', function ($view) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $service_type = ServiceType::query()
                ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
                ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
                ->select('service_types.service_id')
                ->where('order_ceos.restaurant_id', $restaurant_id)
                ->first();
            if($service_type->service_id == 1) {
                $messages = Dish::MESS_RESTAURANT;
            } else {
                $messages = Dish::MESS_SHOP;
            }
            return $view->with([
                'messages' => $messages,
            ]);
        });
        View::composer('restaurant.admin.restaurant.aside', function ($view) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $service_type = ServiceType::query()
                ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
                ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
                ->select('service_types.service_id')
                ->where('order_ceos.restaurant_id', $restaurant_id)
                ->first();
            if($service_type->service_id == 1) {
                $messages = 'Nhà hàng';
            } else {
                $messages = 'Cửa hàng';
            }
            return $view->with([
                'messages' => $messages,
            ]);
        });
    }
}
