<?php

namespace App\Http\Controllers\User\Food;

use App\Http\Controllers\Controller;
use App\Models\OrderUserLog;
use App\Models\Promotion;
use App\Models\Skyline;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFoodPaymentController extends Controller
{
    protected $pathView = 'user.payment.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->cartId) {
            $arr_detail_order_log_id = explode('-', $request->cartId);
            $order_user_logs = OrderUserLog::query()
                ->leftJoin('restaurants', 'restaurants.id', 'order_user_logs.restaurant_id')
                ->leftJoin('detail_order_logs', 'detail_order_logs.order_id', 'order_user_logs.order_id')
                ->select(
                    'order_user_logs.*',
                    'restaurants.name as restaurant_name',
                    'restaurants.id as restaurant_id'
                )
                ->whereIn('detail_order_logs.id', $arr_detail_order_log_id)
                ->groupBy('order_user_logs.order_id')
                ->orderBy('order_user_logs.id')
                ->get();
            if (count($order_user_logs) > 0) {
                $url_home = route('user.food.home.index');
                $user = Auth::guard('user')->user();
                $address = UserAddress::where('user_id', $user->id)->get();
                $skyline = Skyline::first();
                $today = Carbon::now();
                $promotion_skylines = Promotion::query()->where('type', Promotion::ADMINRESTAURANT)->get();
                $title = 'Nhà hàng';
                $url_account = route('user.food.my_account.order');
                return view($this->pathView . 'index', compact('url_home', 'address', 'user', 'skyline', 'order_user_logs', 'today', 'title', 'promotion_skylines', 'arr_detail_order_log_id', 'url_account'));
            }
            return redirect()->route('user.food.cart')->with(['error' => 'Không tồn tại sản phẩm trong giỏ hàng']);
        }
        return redirect()->route('user.food.cart')->with(['error' => 'Không có sản phẩm được chọn']);
    }
}
