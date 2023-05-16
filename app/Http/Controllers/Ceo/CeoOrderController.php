<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Models\Ceo;
use App\Models\OrderCeo;
use App\Models\Promotion;
use App\Models\Restaurant;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\ServiceType;
use App\Models\Skyline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CeoOrderController extends Controller
{
    protected $pathView = 'restaurant.ceo.order.';
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceo = Auth::guard('ceo')->user();
        $datas = OrderCeo::where('ceo_id', $ceo->id)->orderBy('created_at', 'desc')->get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $order = OrderCeo::find($id);
        if($order) {
            $skyline = Skyline::first();
            $service_charge = ServiceCharge::find($order->service_charge_id);
            $service_type = ServiceType::find($service_charge->service_type_id);
            $service = Service::find($service_type->service_id);
            $ceo = Ceo::find($order->ceo_id);
            $restaurant = Restaurant::find($order->restaurant_id);
            $promotions = Promotion::query()
                ->whereIn('id', $order->promotion_id)
                ->get();
            return view($this->pathView . 'print', compact('skyline', 'order', 'service_charge', 'service', 'service_type', 'ceo', 'promotions', 'restaurant'));
        } else {
            abort(404);
        }
    }
}
