<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantLoginController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'restaurant.admin.auth.';

    public function index()
    {
        if (Auth::guard('restaurant')->check() || Auth::guard('personnel')->check()) {
            $data = Auth::guard('restaurant')->check() ? Auth::guard('restaurant')->user() : Restaurant::find(Auth::guard('personnel')->user()->restaurant_id);
            $nowDate = Carbon::now();
            if (strtotime($nowDate) > strtotime(Carbon::parse($data->ended_at))) {
                return view($this->pathView . 'login')->with([
                    'error' => 'Tài khoản acount nhà hàng của bạn đã quá hạn!',
                ]);
            }
            return redirect()->route('restaurant.home.index');
        }
        return view($this->pathView . 'login');
    }

    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        if (Auth::guard('restaurant')->attempt($credentials) || Auth::guard('personnel')->attempt($credentials)) {
            $data = Auth::guard('restaurant')->attempt($credentials) ? Auth::guard('restaurant')->user() : Restaurant::find(Auth::guard('personnel')->user()->restaurant_id);
            $nowDate = Carbon::now();
            if (strtotime($nowDate) > strtotime(Carbon::parse($data->ended_at))) {
                return redirect()->back()->with([
                    'error' => 'Tài khoản acount nhà hàng của bạn đã quá hạn!',
                ]);
            }
            $request->session()->regenerate();
            return redirect()->route('restaurant.home.index');
        }
        return redirect()->back()->with([
            'error' => __('messages.admin.login.fail'),
        ]);
    }

    public function logout()
    {
        if (Auth::guard('restaurant')->check()) {
            Auth::guard('restaurant')->logout();
        }
        if (Auth::guard('personnel')->check()) {
            Auth::guard('personnel')->logout();
        }
        session()->forget('branch_id');
        return redirect()->route('restaurant.login');
    }
}
