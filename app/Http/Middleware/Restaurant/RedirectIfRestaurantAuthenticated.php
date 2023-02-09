<?php

namespace App\Http\Middleware\Restaurant;

use App\Models\Restaurant;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfRestaurantAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('restaurant')->check() && !Auth::guard('personnel')->check()) {
            return redirect()->route('restaurant.login');
        } else {
            $data = Auth::guard('restaurant')->check() ? Auth::guard('restaurant')->user() : Restaurant::find(Auth::guard('personnel')->user()->restaurant_id);
            $nowDate = Carbon::now();
            if (strtotime($nowDate) > strtotime(Carbon::parse($data->ended_at))) {
                return redirect()->route('restaurant.login');
            }
        }
        return $next($request);
    }
}
