<?php

namespace App\Http\Controllers\User\Food;

use App\Http\Controllers\Controller;
use App\Models\CategoryHome;
use App\Models\Dish;
use App\Models\Image;
use App\Models\Promotion;
use Illuminate\Http\Request;

class UserFoodHomeController extends Controller
{
    protected $pathView = 'user.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('type', Image::WEBUSERFOOD)->inRandomOrder()->limit(3)->get();
        $promotions = Promotion::where('type', Promotion::ADMINRESTAURANT)->inRandomOrder()->limit(3)->get();
        $categoryHomes = CategoryHome::where('service_id', 1)->get();
        $dishes = Dish::query()
            ->leftJoin('restaurants', 'restaurants.id', 'dishes.restaurant_id')
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->select('dishes.*')
            ->where('service_types.service_id', 1)
            ->inRandomOrder()->limit(32)
            ->get();
        $url_allProduct = route('user.food.allProduct.index');
        $url_show = 'user.food.product.show';
        return view($this->pathView.'index', compact('images' , 'promotions', 'categoryHomes', 'dishes' , 'url_allProduct' , 'url_show'));
    }
}
