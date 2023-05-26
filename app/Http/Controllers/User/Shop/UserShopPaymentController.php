<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\Skyline;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserShopPaymentController extends Controller
{
    protected $pathView = 'user.payment.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_home = route('user.home.index');
        $user = Auth::guard('user')->user();
        $address = UserAddress::where('user_id', $user->id)->get();
        $skyline = Skyline::first();
        return view($this->pathView . 'index', compact('url_home', 'address', 'user', 'skyline'));
    }
}
