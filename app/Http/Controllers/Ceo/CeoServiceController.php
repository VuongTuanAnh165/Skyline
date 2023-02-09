<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CeoServiceController extends Controller
{
    protected $pathView = 'restaurant.ceo.service.';

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceo = Auth::guard('ceo')->user();
        $datas = Restaurant::query()
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->leftJoin('services', 'services.id', 'service_types.service_id')
            ->select(
                'restaurants.*',
                'services.name as service_name',
                'services.image as service_image',
                'service_charges.month as service_charge_month',
                'order_ceos.total as order_ceo_total',
            )
            ->where('restaurants.ceo_id', $ceo->id)
            ->get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ceo = Auth::guard('ceo')->user();
        $datas = Restaurant::query()
        ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
        ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
        ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
        ->leftJoin('services', 'services.id', 'service_types.service_id')
        ->select(
            'restaurants.*',
            'services.name as service_name',
            'services.image as service_image',
            'service_charges.month as service_charge_month',
            'order_ceos.total as order_ceo_total',
        )
            ->where('restaurants.ceo_id', $ceo->id)
            ->get();
        return view($this->pathView . 'index', compact('datas'));
    }
}
