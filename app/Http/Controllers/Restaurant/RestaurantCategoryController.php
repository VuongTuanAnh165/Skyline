<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateogryRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class RestaurantCategoryController extends Controller
{
    protected $pathView = 'restaurant.admin.dish.category.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $datas = Category::query()
            ->where('restaurant_id', $restaurant_id)
            ->get();
        $service_type = ServiceType::query()
            ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
            ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
            ->select('service_types.service_id')
            ->where('order_ceos.restaurant_id', $restaurant_id)
            ->first();
        if($service_type->service_id == 1) {
            $messages = Dish::MESS_RESTAURANT;
        } else {
            $messages = Dish::MESS_SHOP;
        }
        return view($this->pathView . 'index', compact('datas', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CateogryRequest $request)
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name'
            ]);
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/category/', 'image', $request);
            }
            $params['restaurant_id'] = $restaurant_id;
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            if(Auth::guard('personnel')->user()) {
                $params['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['create_by'] = -1;
            }
            $data = Category::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[RestaurantCategoryController][store] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::find($request->id);
            $image = !empty($category->image) ? asset('storage/' . $category->image) : '';
            return response()->json([
                'category' => $category,
                'image' => $image,
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
    public function update(CateogryRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = Category::find($id);
                DB::beginTransaction();
                $params = $request->only([
                    'name'
                ]);
                $params['name_link'] = ConvertNameHelper::convertName($request->name);
                if ($request->hasFile('image')) {
                    Storage::delete($data->image);
                    $params['image'] = UploadsHelper::handleUploadFile('img/category/', 'image', $request);
                }
                if(Auth::guard('personnel')->user()) {
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
                Log::error('[RestaurantPositionController][update] error ' . $e->getMessage());
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
