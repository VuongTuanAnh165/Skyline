<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserShopCartController extends Controller
{
    protected $pathView = 'user.cart.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_user_logs = OrderUserLog::query()
            ->leftJoin('restaurants', 'restaurants.id', 'order_user_logs.restaurant_id')
            ->select(
                'order_user_logs.*',
                'restaurants.name as restaurant_name'
            )
            ->where('user_id', Auth::guard('user')->user()->id)
            ->get();
        $url_home = route('user.home.index');
        $title_product = "Sản phẩm";
        $url_show = 'user.product.show';
        $dishes = Dish::query()
            ->leftJoin('restaurants', 'restaurants.id', 'dishes.restaurant_id')
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->select('dishes.*')
            ->where('service_types.service_id', 2)
            ->orderBy('dishes.updated_at', 'DESC')
            ->get();
        return view($this->pathView . 'index', compact('order_user_logs', 'url_home', 'title_product', 'url_show', 'dishes'));
    }
}
