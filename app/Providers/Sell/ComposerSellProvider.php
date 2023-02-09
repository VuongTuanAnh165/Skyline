<?php

namespace App\Providers\Sell;

use App\Models\Branch;
use App\Models\Ceo;
use App\Models\Restaurant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ComposerSellProvider extends ServiceProvider
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
        View::composer('restaurant.sell.layouts.aside', function ($view) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $restaurant = Restaurant::find($restaurant_id);
            $account = Auth::guard('restaurant')->user() ? Ceo::find(Auth::guard('restaurant')->user()->ceo_id) : Auth::guard('personnel')->user();
            return $view->with([
                'restaurant' => $restaurant,
                'account' => $account,
            ]);
        });

        View::composer('restaurant.sell.layouts.header', function ($view) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $restaurant = Restaurant::find($restaurant_id);
            $branch = Branch::find(session('branch_id'));
            return $view->with([
                'restaurant' => $restaurant,
                'branch' => $branch,
            ]);
        });

        View::composer('restaurant.sell.layouts.master', function ($view) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $restaurant = Restaurant::find($restaurant_id);
            return $view->with([
                'restaurant' => $restaurant,
            ]);
        });
    }
}
