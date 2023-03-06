<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserShopRestaurantController extends Controller
{
    protected $pathView = 'user.restaurant.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $restaurant = Restaurant::find($id);
        $categories = Category::where('restaurant_id', $id)->get();
        return view($this->pathView.'index', compact('restaurant', 'categories'));
    }
}
