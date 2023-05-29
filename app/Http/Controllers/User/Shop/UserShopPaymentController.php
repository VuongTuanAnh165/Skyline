<?php

namespace App\Http\Controllers\User\Shop;

use App\Http\Controllers\Controller;
use App\Models\DetailOrderLog;
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
    public function index(Request $request)
    {
        if ($request->cartId) {
            $arr_detail_order_log_id = explode('-', $request->cartId);
            $detail_order_logs = DetailOrderLog::leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                ->select('detail_order_logs.*', 'dishes.id as dish_id', 'dishes.name_link as name_link', 'dishes.name as dish_name', 'dishes.price as dish_price', 'dishes.image as dish_image')
                ->whereIn('detail_order_logs.id', $arr_detail_order_log_id)
                ->get();
            if (count($detail_order_logs) > 0) {
                $url_home = route('user.home.index');
                $user = Auth::guard('user')->user();
                $address = UserAddress::where('user_id', $user->id)->get();
                $skyline = Skyline::first();
                return view($this->pathView . 'index', compact('url_home', 'address', 'user', 'skyline', 'detail_order_logs'));
            }
            return redirect()->route('user.cart')->with(['error' => 'Không tồn tại sản phẩm trong giỏ hàng']);
        }
        return redirect()->route('user.cart')->with(['error' => 'Không có sản phẩm được chọn']);
    }
}
