<?php

namespace App\Http\Middleware\Restaurant;

use App\Models\Restaurant;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfRestaurant
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
            abort(404);
        }
        $restaurant_id = Auth::guard('restaurant')->check() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $data = Restaurant::query()
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->where('service_types.service_id', 1)
            ->where('restaurants.id', $restaurant_id)
            ->first();
        if(!$data) {
            abort(404);
        }
        return $next($request);
    }
}
