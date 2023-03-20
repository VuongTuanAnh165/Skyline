<?php

namespace App\Providers\User;

use App\Models\Branch;
use App\Models\CategoryHome;
use App\Models\Ceo;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
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
                'user.food.restaurant.post'
            );
            $url = [
                'logo' => asset('img/logo_shop.png'),
                'home' => route('user.home.index'),
                'name' => 'Sản phẩm',
                'categoryHome' => CategoryHome::where('service_id', 2)->get(),
                'allProduct' => route('user.allProduct.index'),
            ];
            if (in_array($name, $arr_route_food)) {
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
                'user.food.restaurant.post'
            );
            $url = [
                'logo' => asset('img/logo_shop.png'),
                'home' => route('user.home.index'),
                'name' => 'Sản phẩm',
                'categoryHome' => CategoryHome::where('service_id', 2)->get(),
                'allProduct' => route('user.allProduct.index'),
                'product' => route('user.product.index'),
                'service_id' => 2,
                'order_user_type' => OrderUser::TYPE_SHOP_SHIP,
                'cart' => route('user.cart'),
            ];
            if (in_array($name, $arr_route_food)) {
                $url = [
                    'logo' => asset('img/logo.png'),
                    'home' => route('user.food.home.index'),
                    'name' => 'Món ăn',
                    'categoryHome' => CategoryHome::where('service_id', 1)->get(),
                    'allProduct' => route('user.food.allProduct.index'),
                    'product' => route('user.food.product.index'),
                    'service_id' => 1,
                    'order_user_type' => OrderUser::TYPE_RESTAURANT_SHIP,
                    'cart' => route('user.food.cart'),
                ];
            }
            $user = Auth::guard('user')->user();
            $order_user_log = OrderUserLog::query()
                ->leftJoin('detail_order_logs', 'detail_order_logs.order_id', 'order_user_logs.order_id')
                ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'dishes.restaurant_id')
                ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
                ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
                ->select('order_user_logs.*')
                ->where('order_user_logs.type', $url['order_user_type'])
                ->whereNull('order_user_logs.status');
            if($user) {
                $order_user_log = $order_user_log->where('order_user_logs.user_id', $user->id);
            } else {
                $order_user_log = $order_user_log->where('order_user_logs.user_id', -1);
            }
            if (in_array($name, $arr_route_food)) {
                $order_user_log = $order_user_log->where('service_types.service_id', 1);
            } else {
                $order_user_log = $order_user_log->where('service_types.service_id', 2);
            }
            $order_user_log = $order_user_log->get();
            return $view->with([
                'url' => $url,
                'name' => $name,
                'arr_route_food' => $arr_route_food,
                'user' => $user,
                'order_user_log' => $order_user_log,
            ]);
        });
        View::composer('user.layouts.master', function ($view) {
            $name = Route::currentRouteName();
            $arr_route_food = array(
                'user.food.home.index',
                'user.food.allProduct.index',
                'user.food.product.index',
                'user.food.product.show',
                'user.food.restaurant.index',
                'user.food.restaurant.post'
            );
            $url_product = 'user.product.show';
            if (in_array($name, $arr_route_food)) {
                $url_product = 'user.food.product.show';
            }
            return $view->with([
                'name' => $name,
                'arr_route_food' => $arr_route_food,
                'url_product' => $url_product,
            ]);
        });
    }
}
