<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\Image;
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
        return view($this->pathView.'index', compact('images'));
    }
}
