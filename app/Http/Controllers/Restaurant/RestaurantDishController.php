<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Http\Requests\MenuRequest;
use App\Models\Branch;
use App\Models\Category;
use App\Models\CategoryHome;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantDishController extends Controller
{
    protected $pathView = 'restaurant.admin.dish.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $datas = Dish::query()
            ->leftJoin('categories', 'categories.id', 'dishes.category_id')
            ->select('dishes.*', 'categories.name as category_name')
            ->where('categories.restaurant_id', $restaurant_id)
            ->where('dishes.restaurant_id', $restaurant_id)
            ->get();
        $categories = Category::query()
            ->where('restaurant_id', $restaurant_id)
            ->get();
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
        return view($this->pathView . 'index', compact('datas', 'categories', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $categories = Category::query()
            ->where('restaurant_id', $restaurant_id)
            ->get();
        $branches = Branch::where('restaurant_id', $restaurant_id)->get();
        $categoryHomes = CategoryHome::query()
            ->leftJoin('service_types', 'service_types.service_id', 'category_homes.service_id')
            ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
            ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
            ->select('category_homes.*')
            ->where('order_ceos.restaurant_id', $restaurant_id)
            ->get();
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
        return view($this->pathView . 'create', compact('categories', 'branches', 'categoryHomes', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'category_id',
                'price',
                'content',
                'category_home_id',
                'branch_id',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $params['restaurant_id'] = $restaurant_id;
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/dish/', 'image', $request);
            }
            if (Auth::guard('personnel')->user()) {
                $params['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['create_by'] = -1;
            }
            $data = Dish::create($params);
            DB::commit();
            return redirect()->route('restaurant.dish.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantdishController][store] error ' . $e->getMessage());
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
        $data = Dish::find($id);
        if ($data) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $categories = Category::query()
                ->where('restaurant_id', $restaurant_id)
                ->get();
            $branches = Branch::where('restaurant_id', $restaurant_id)->get();
            $categoryHomes = CategoryHome::query()
                ->leftJoin('service_types', 'service_types.service_id', 'category_homes.service_id')
                ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
                ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
                ->select('category_homes.*')
                ->where('order_ceos.restaurant_id', $restaurant_id)
                ->get();
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
            return view($this->pathView . 'edit', compact('data', 'categories', 'branches', 'categoryHomes', 'messages'));
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
    public function update(DishRequest $request, $id)
    {
        try {
            $data = Dish::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'category_id',
                'price',
                'content',
                'category_home_id',
                'branch_id',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            if ($request->hasFile('image')) {
                Storage::delete($data->image);
                $params['image'] = UploadsHelper::handleUploadFile('img/dish/', 'image', $request);
            }
            if (Auth::guard('personnel')->user()) {
                $params['update_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['update_by'] = -1;
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.dish.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantdishController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMenu(Request $request)
    {
        $menus = Menu::where('dish_id', $request->id)->get();
        return response()->json([
            'code' => 200,
            'menus' => $menus,
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
    public function storeMenu(MenuRequest $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $params = $request->only([
                    'dish_id',
                    'name',
                    'required',
                    'multiple',
                ]);
                $data = Menu::create($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantdishController][storeMenu] error ' . $e->getMessage());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMenu(MenuRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = Menu::find($request->id);
                DB::beginTransaction();
                $params = $request->only([
                    'dish_id',
                    'name',
                    'required',
                    'multiple',
                ]);
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantdishController][updateMenu] error ' . $e->getMessage());
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
     * destroy the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Menu::find($request->id);
                $data->delete();
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantdishController][destroyMenu] error ' . $e->getMessage());
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
