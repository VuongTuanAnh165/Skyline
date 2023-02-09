<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantPromotionController extends Controller
{
    protected $pathView = 'restaurant.admin.promotion.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $datas = Promotion::query()->where('type', 3)->where('restaurant_id', $restaurant_id)->get();
        return view($this->pathView.'index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->pathView.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'type',
                'condition',
                'value',
                'started_at',
                'ended_at',
            ]);
            $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
            $data = Promotion::create($params);
            DB::commit();
            return redirect()->route('restaurant.promotion.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPromotionController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Promotion::find($id);
        if($data) {
            return view($this->pathView.'edit', compact('data'));
        }
        return redirect()->back()->with(['error' => trans('messages.common.error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionRequest $request, $id)
    {
        try {
            $data = Promotion::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'type',
                'condition',
                'value',
                'started_at',
                'ended_at',
            ]);
            $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.promotion.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPromotionController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
