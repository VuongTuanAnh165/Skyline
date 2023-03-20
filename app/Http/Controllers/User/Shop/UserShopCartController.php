<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
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
        return view($this->pathView . 'index', compact('order_user_logs', 'url_home', 'title_product', 'url_show'));
    }
}
