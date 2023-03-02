<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Image;
use Illuminate\Http\Request;

class UserShopAllProductController extends Controller
{
    protected $pathView = 'user.all_product.';

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::query()
            ->leftJoin('restaurants', 'restaurants.id', 'dishes.restaurant_id')
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->select('dishes.*')
            ->where('service_types.service_id', 2)
            ->paginate(16);
        $title = "Tất cả sản phẩm";
        $url_home = route('user.home.index');
        return view($this->pathView.'index', compact('dishes', 'title', 'url_home'));
    }
}
