<?php

namespace App\Http\Controllers\User\Food;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserFoodRestaurantController extends Controller
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
