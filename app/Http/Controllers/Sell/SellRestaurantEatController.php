<?php

namespace App\Http\Controllers\Sell;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\DetailItemLog;
use App\Models\DetailMenuLog;
use App\Models\DetailOrderLog;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
use App\Models\Promotion;
use App\Models\Restaurant;
use App\Models\Table;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SellRestaurantEatController extends Controller
{
    protected $pathView = 'restaurant.sell.restaurant.eat.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_id = session('branch_id');
        $tables = Table::where('branch_id', $branch_id)->orderBy('id')->simplePaginate(8);
        return view($this->pathView . 'index', compact('tables'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($table_id)
    {
        $branch_id = session('branch_id');
        try {
            $nowDate = Carbon::now();
            $str = str_replace('-', '', $nowDate->toDateTimeString());
            $str = str_replace(':', '', $str);
            $str = str_replace(' ', '', $str);
            $order_id = Str::random(5) . '_' . $str;
            $data_order_user_log = [
                'order_id' => $order_id,
                'table_id' => [$table_id],
                'branch_id' => $branch_id,
                'status' => [
                    [
                        OrderUser::ORDER_CONFIRMED,
                        Carbon::now()->toDateTimeString(),
                    ],
                    [
                        OrderUser::RESTAURANT_PREPARE,
                        Carbon::now()->toDateTimeString(),
                    ]
                ],
                'type' => OrderUser::TYPE_RESTAURANT_EAT,
                'status_payment' => OrderUser::UNPAID,
            ];
            if (Auth::guard('personnel')->user()) {
                $data_order_user_log['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $data_order_user_log['create_by'] = -1;
            }
            $order_user_log = OrderUserLog::create($data_order_user_log);
            Table::whereIn('id', $order_user_log->table_id)->update(['status' => 1]);
            return response()->json([
                'code' => 200,
                'url' => route('sell.restaurant.eat.edit', ['table_id' => $table_id]),
            ]);
        } catch (Exception $e) {
            Log::error('[SellRestaurantEatController][create] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($table_id)
    {
        $order_user_log_all = OrderUserLog::where('type',OrderUser::TYPE_RESTAURANT_EAT)->get();
        $order_user_log = [];
        $arr_table = [];
        foreach ($order_user_log_all as $item) {
            if (in_array($table_id, $item->table_id)) {
                array_push($order_user_log, $item);
            } else {
                foreach ($item->table_id as $value) {
                    array_push($arr_table, $value);
                }
            }
        }
        if (count($order_user_log) > 0) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $branch_id = session('branch_id');
            $tables = Table::where('branch_id', $branch_id)->whereNotIn('id', $arr_table)->get();
            $status = OrderUser::STATUS;
            $dishes = Dish::where('restaurant_id', $restaurant_id)->get();
            $detail_order_log = DetailOrderLog::query()
                ->leftJoin('detail_menu_logs', 'detail_menu_logs.detail_order_log_id', 'detail_order_logs.id')
                ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                ->leftJoin('menus', 'menus.id', 'detail_menu_logs.menu_id')
                ->select(
                    'detail_order_logs.*',
                    'dishes.name as dish_name',
                    DB::raw('group_concat(detail_menu_logs.id) as detail_menu_log_id'),
                    DB::raw('group_concat(menus.name) as menu_name')
                )
                ->where('detail_order_logs.order_id', $order_user_log[0]->order_id)
                ->groupBy(
                    'detail_order_logs.id',
                )
                ->get();
            $dish_id = DetailOrderLog::select('dish_id')->where('order_id', $order_user_log_all[0]->order_id)->pluck('dish_id')->all();
            return view($this->pathView . 'edit', compact('order_user_log', 'tables', 'status', 'dishes', 'detail_order_log', 'dish_id'));
        }
        return redirect()->back()->with(['error' => trans('messages.common.error')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTable(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $data = OrderUserLog::where('order_id', $request->order_id)->first();
                Table::whereIn('id', $data->table_id)->update(['status' => 0]);
                $params = $request->only([
                    'table_id',
                ]);
                if (Auth::guard('personnel')->user()) {
                    $params['update_by'] = Auth::guard('personnel')->user()->id;
                } else {
                    $params['update_by'] = -1;
                }
                $data->update($params);
                Table::whereIn('id', $data->table_id)->update(['status' => 1]);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][addTable] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStatus(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $data = OrderUserLog::where('order_id', $request->order_id)->first();
                $status = $data->status;
                $status_new = [
                    $request->status,
                    Carbon::now()->toDateTimeString(),
                ];
                array_push($status, $status_new);
                $params['status'] = $status;
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
                Log::error('[SellRestaurantEatController][addStatus] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDish(Request $request)
    {
        if ($request->ajax()) {
            $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
            $branch_id = session('branch_id');
            $list_dish_id = DetailOrderLog::where('order_id', $request->order_id)->pluck('dish_id')->all();
            $dishes = Dish::where('restaurant_id', $restaurant_id)->whereNotIn('id', $list_dish_id)->get();
            return response()->json([
                'dishes' => $dishes,
                'branch_id' => $branch_id,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDish(Request $request)
    {
        if ($request->ajax()) {
            try {
                foreach ($request->dish_id as $item) {
                    $data_detail_order_log = [
                        'dish_id' => $item,
                        'order_id' => $request->order_id,
                        'quantity' => 1,
                    ];
                    $detail_order_log = DetailOrderLog::create($data_detail_order_log);
                    $menus = Menu::where('dish_id', $item)->get();
                    foreach ($menus as $menu) {
                        $data_detail_menu_log = [
                            'detail_order_log_id' => $detail_order_log->id,
                            'menu_id' => $menu->id,
                        ];
                        DetailMenuLog::create($data_detail_menu_log);
                    }
                }
                $data = DetailOrderLog::query()
                    ->leftJoin('detail_menu_logs', 'detail_menu_logs.detail_order_log_id', 'detail_order_logs.id')
                    ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                    ->leftJoin('menus', 'menus.id', 'detail_menu_logs.menu_id')
                    ->select(
                        'detail_order_logs.*',
                        'dishes.name as dish_name',
                        DB::raw('group_concat(detail_menu_logs.id) as detail_menu_log_id'),
                        DB::raw('group_concat(menus.name) as menu_name')
                    )
                    ->where('detail_order_logs.order_id', $request->order_id)
                    ->groupBy('detail_order_logs.id')
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][addDish] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteDish(Request $request)
    {
        if ($request->ajax()) {
            try {
                DetailMenuLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_menu_logs.detail_order_log_id')
                    ->where('detail_order_logs.id', $request->detail_order_log_id)->delete();
                DetailItemLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_item_logs.detail_order_log_id')
                    ->where('detail_order_logs.id', $request->detail_order_log_id)->delete();
                DetailOrderLog::where('id', $request->detail_order_log_id)->delete();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][deleteDish] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quantity(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = DetailOrderLog::find($request->id);
                $count_detail_item_log = DetailItemLog::where('detail_order_log_id', $request->id)->count();
                if ($count_detail_item_log > $request->quantity) {
                    DetailItemLog::where('detail_order_log_id', $request->id)->orderBy('id', 'desc')->limit($count_detail_item_log - $request->quantity)->delete();
                }
                $params = [
                    'quantity' => $request->quantity,
                ];
                $data->update($params);
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][quantity] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showItem(Request $request)
    {
        if ($request->ajax()) {
            $detail_menu_logs = DetailMenuLog::query()
                ->leftJoin('menus', 'menus.id', 'detail_menu_logs.menu_id')
                ->leftJoin('menu_items', 'menu_items.menu_id', 'menus.id')
                ->select(
                    'detail_menu_logs.*',
                    'menus.name as menu_name',
                    'menus.required',
                    'menus.multiple',
                    DB::raw('group_concat(menu_items.name) as item_name'),
                    DB::raw('group_concat(menu_items.id) as item_id'),
                )
                ->where('detail_menu_logs.detail_order_log_id', $request->detail_order_log_id)
                ->groupBy('detail_menu_logs.id')
                ->get();
            $detail_order_log = DetailOrderLog::query()
                ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                ->select(
                    'detail_order_logs.*',
                    'dishes.name as dish_name',
                )
                ->where('detail_order_logs.id', $request->detail_order_log_id)
                ->first();
            $detail_item_logs = DetailItemLog::where('detail_order_log_id', $request->detail_order_log_id)->get();
            return response()->json([
                'code' => 200,
                'detail_menu_logs' => $detail_menu_logs,
                'detail_order_log' => $detail_order_log,
                'detail_item_logs' => $detail_item_logs,
            ]);
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveItem(Request $request)
    {
        if ($request->ajax()) {
            try {
                DetailItemLog::where('detail_order_log_id', $request->detail_order_log_id)->delete();
                foreach ($request->array_item as $key => $value) {
                    $params = [
                        'detail_order_log_id' => $request->detail_order_log_id,
                        'item' => $value
                    ];
                    DetailItemLog::create($params);
                }
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][saveItem] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteOrder(Request $request)
    {
        if ($request->ajax()) {
            try {
                DetailMenuLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_menu_logs.detail_order_log_id')
                    ->where('detail_order_logs.order_id', $request->order_id)->delete();
                DetailItemLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_item_logs.detail_order_log_id')
                    ->where('detail_order_logs.order_id', $request->order_id)->delete();
                DetailOrderLog::where('order_id', $request->order_id)->delete();
                $data = OrderUserLog::where('order_id', $request->order_id)->first();
                Table::whereIn('id', $data->table_id)->update(['status' => 0]);
                OrderUserLog::where('order_id', $request->order_id)->delete();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][deleteOrder] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment($order_id)
    {
        $order_user_log = OrderUserLog::where('order_id', $order_id)->first();
        $detail_order_logs = DetailOrderLog::query()
            ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
            ->select(
                'detail_order_logs.*',
                'dishes.name as dish_name',
                'dishes.price as dish_price',
            )
            ->where('order_id', $order_id)->get();
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $promotions = Promotion::query()->where('type', 3)->where('restaurant_id', $restaurant_id)->get();
        return view($this->pathView . 'payment', compact('order_user_log', 'detail_order_logs', 'promotions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPromotion(Request $request, $order_id)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $data = OrderUserLog::where('order_id', $order_id)->first();
                $params = $request->only([
                    'promotion_id',
                ]);
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
                Log::error('[SellRestaurantEatController][addPromotion] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request, $order_id)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $data = OrderUserLog::where('order_id', $order_id)->first();
                //update table
                Table::whereIn('id', $data->table_id)->update(['status' => 0]);
                //update status
                $status = $data->status;
                $status_new = [
                    10,
                    Carbon::now()->toDateTimeString(),
                ];
                array_push($status, $status_new);
                $detail_order = DetailOrderLog::where('order_id', $order_id)->get();
                $detail = [];
                foreach($detail_order as $value_order) {
                    $detail_item = DetailItemLog::where('detail_order_log_id', $value_order->id)->get();
                    $item = [];
                    foreach($detail_item as $value_item) {
                        array_push($item, $value_item->item);
                    }
                    $dish = [
                        $value_order->dish_id,
                        $value_order->quantity,
                        $item
                    ];
                    array_push($detail, $dish);
                }
                $params = [
                    'order_id' => $order_id,
                    'table_id' => $data->table_id,
                    'total_money' => $request->total_money,
                    'payment' => $request->payment,
                    'branch_id' => $data->branch_id,
                    'create_by' => $data->create_by,
                    'update_by' => $data->update_by,
                    'status_payment' => 1,
                    'status' => $status,
                    'type' => $data->type,
                    'promotion_id' => $request->promotion_id,
                    'implementation_date' => Carbon::now()->toDateTimeString(),
                    'detail' => $detail,
                    'created_at' => $data->created_at,
                ];
                OrderUserLog::where('order_id', $order_id)->delete();
                DetailMenuLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_menu_logs.detail_order_log_id')
                    ->where('detail_order_logs.order_id', $order_id)->delete();
                DetailItemLog::query()
                    ->leftJoin('detail_order_logs', 'detail_order_logs.id', 'detail_item_logs.detail_order_log_id')
                    ->where('detail_order_logs.order_id', $order_id)->delete();
                DetailOrderLog::where('order_id', $order_id)->delete();
                $order_user = OrderUser::create($params);
                $url = route('sell.restaurant.eat.print', ['id' => $order_user->id]);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'url' => $url,
                ]);
            } catch (Exception $e) {
                Log::error('[SellRestaurantEatController][pay] error ' . $e->getMessage());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $branch_id = session('branch_id');
        $datas = OrderUser::where('branch_id', $branch_id)->orderBy('implementation_date', 'desc')->get();
        return view($this->pathView . 'order', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $restaurant = Restaurant::find($restaurant_id);
        $data = OrderUser::find($id);
        $branch_id = session('branch_id');
        $branch = Branch::find($branch_id);
        return view($this->pathView . 'print', compact('restaurant', 'data', 'branch'));
    }
}
