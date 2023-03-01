<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\CategoryHome;
use App\Models\Image;
use App\Models\Promotion;
use Illuminate\Http\Request;

class UserShopHomeController extends Controller
{
    protected $pathView = 'user.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('type', Image::WEBUSERSHOP)->inRandomOrder()->limit(3)->get();
        $promotions = Promotion::where('type', Promotion::ADMINRESTAURANT)->inRandomOrder()->limit(3)->get();
        $categoryHomes = CategoryHome::where('service_id', 2)->get();
        return view($this->pathView.'index', compact('images' , 'promotions', 'categoryHomes'));
    }
}
