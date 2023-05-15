<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantMenuController extends Controller
{
    protected $pathView = 'restaurant.admin.dish.menu.item.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemShow(Request $request)
    {
        $items = MenuItem::where('menu_id', $request->menu_id)->get();
        return response()->json([
            'code' => 200,
            'items' => $items,
        ]);
        return response()->json([
            'code' => 400,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemStore(ItemRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
            ]);
            $params['add_price'] = $request->add_price ? $request->add_price : 0;
            $params['menu_id'] = $request->menu_id;
            if (Auth::guard('personnel')->user()) {
                $params['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['create_by'] = -1;
            }
            $data = MenuItem::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            Log::error('[RestaurantMenuController][itemStore] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemUpdate(ItemRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = MenuItem::find($request->id);
                $params = $request->only([
                    'name',
                ]);
                $params['add_price'] = $request->add_price ? $request->add_price : 0;
                $params['menu_id'] = $request->menu_id;
                if (Auth::guard('personnel')->user()) {
                    $params['update_by'] = Auth::guard('personnel')->user()->id;
                } else {
                    $params['update_by'] = -1;
                }
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantMenuController][itemUpdate] error ' . $e->getMessage());
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
}
