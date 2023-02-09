<?php

namespace App\Http\Controllers\Sell;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Branch;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellAuthController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'restaurant.sell.auth.';

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
            return redirect()->route('sell.branch');
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
            return redirect()->route('sell.branch');
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
        return redirect()->route('sell.login');
    }

    public function branch() {
        if(session('branch_id')) {
            return redirect()->route('sell.home.index');
        }
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $branches = Branch::where('restaurant_id', $restaurant_id)->get();
        $restaurant = Restaurant::find($restaurant_id);
        return view($this->pathView . 'branch', compact('branches', 'restaurant'));
    }

    public function branchPost(Request $request) {
        if ($request->ajax()) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $branch = Branch::where('restaurant_id', $restaurant_id)->where('id', $request->branch_id)->first();
            if($branch) {
                session()->put('branch_id', $request->branch_id);
                return response()->json([
                    'code' => 200,
                ]);
            }
        }
    }

    public function changeBranch()
    {
        session()->forget('branch_id');
        return redirect()->route('sell.branch');
    }
}
