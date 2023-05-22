<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Models\Evaluate;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                'restaurants.id as restaurant_id',
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
    public function rating(RatingRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $params = $request->only([
                    'product_id',
                    'comment',
                    'star',
                ]);
                $params['people_id'] = Auth::guard('ceo')->user()->id;
                $params['web_type'] = 1;
                $data = Evaluate::create($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[CeoServiceController][rating] error ' . $e->getMessage());
                DB::rollBack();
                return response()->json([
                    'code' => 400,
                ]);
            }
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRating(Request $request)
    {
        if ($request->ajax()) {
            $data = Evaluate::where('product_id', $request->product_id)
                ->where('people_id', Auth::guard('ceo')->user()->id)
                ->where('web_type', 1)
                ->first();
            if ($data) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            }
            return response()->json([
                'code' => 400,
            ]);
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }
}
