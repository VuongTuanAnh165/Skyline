<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderUser;
use Illuminate\Http\Request;

class UserMyAcountController extends Controller
{
    /**
     * Display a listing of the resource.
     * Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetail(Request $request)
    {
        $data = OrderUser::leftJoin('restaurants', 'restaurants.id', 'order_users.restaurant_id')
            ->select(
                'order_users.*',
                'restaurants.name as restaurant_name'
            )
            ->where('order_id', $request->order_id)->first();
        $url_show = $request->url_show;
        return view('user.my_account.modal.detail_order', compact('data', 'url_show'));
    }
}
