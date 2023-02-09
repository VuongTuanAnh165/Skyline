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
    public function index($id)
    {
        $datas = MenuItem::where('menu_id', $id)->get();
        $menu = Menu::query()
            ->leftJoin('dishes', 'dishes.id', 'menus.dish_id')
            ->select('menus.*', 'dishes.name as dish_name')
            ->where('menus.id', $id)
            ->first();
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $service_type = ServiceType::query()
            ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
            ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
            ->select('service_types.service_id')
            ->where('order_ceos.restaurant_id', $restaurant_id)
            ->first();
        if ($service_type->service_id == 1) {
            $messages = Dish::MESS_RESTAURANT;
        } else {
            $messages = Dish::MESS_SHOP;
        }
        return view($this->pathView . 'index', compact('datas', 'menu', 'messages', 'service_type'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemShow(Request $request)
    {
        if ($request->ajax()) {
            $item = MenuItem::find($request->id);
            $image = !empty($item->image) ? asset('storage/' . $item->image) : '';
            return response()->json([
                'item' => $item,
                'image' => $image,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemStore(ItemRequest $request, $menu_id)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
            ]);
            $params['add_price'] = $request->add_price ? $request->add_price : 0;
            $params['menu_id'] = $menu_id;
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/item/', 'image', $request);
            }
            if (Auth::guard('personnel')->user()) {
                $params['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['create_by'] = -1;
            }
            $data = MenuItem::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
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
    public function itemUpdate(ItemRequest $request, $menu_id, $id)
    {
        if ($request->ajax()) {
            try {
                $data = MenuItem::find($id);
                $params = $request->only([
                    'name',
                ]);
                $params['add_price'] = $request->add_price ? $request->add_price : 0;
                $params['menu_id'] = $menu_id;
                if ($request->hasFile('image')) {
                    Storage::delete($data->image);
                    $params['image'] = UploadsHelper::handleUploadFile('img/item/', 'image', $request);
                }
                if (Auth::guard('personnel')->user()) {
                    $params['update_by'] = Auth::guard('personnel')->user()->id;
                } else {
                    $params['update_by'] = -1;
                }
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
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
