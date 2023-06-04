<?php

namespace App\Http\Controllers\User\Food;

use App\Http\Controllers\Controller;
use App\Models\OrderUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFoodMyAcountController extends Controller
{
    protected $pathView = 'user.my_account.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $user = Auth::guard('user')->user();
        $orders = OrderUser::where('user_id', $user->id)->where('type', OrderUser::TYPE_RESTAURANT_SHIP)->orderBy('created_at', 'DESC')->get();
        $status = OrderUser::STATUS;
        $status_payment = OrderUser::STATUS_PAYMENT;
        $url_home = route('user.food.home.index');
        return view($this->pathView.'order', compact('user', 'orders', 'status', 'status_payment', 'url_home'));
    }
}
