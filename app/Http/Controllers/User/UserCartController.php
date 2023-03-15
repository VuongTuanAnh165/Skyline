<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailItemLog;
use App\Models\DetailMenuLog;
use App\Models\DetailOrderLog;
use App\Models\Menu;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
use App\Models\ServiceType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserCartController extends Controller
{
    protected $pathView = 'user.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $nowDate = Carbon::now();
                $str = str_replace('-', '', $nowDate->toDateTimeString());
                $str = str_replace(':', '', $str);
                $str = str_replace(' ', '', $str);
                $order_id = Str::random(5) . '_' . $str;
                $service = ServiceType::query()
                    ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
                    ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
                    ->leftJoin('dishes', 'dishes.restaurant_id', 'order_ceos.restaurant_id')
                    ->select('service_types.service_id as service_id')
                    ->where('dishes.id', $request->dish_id)
                    ->first();
                if ($service->service_id == 1) {
                    $type = OrderUser::TYPE_RESTAURANT_SHIP;
                } else {
                    $type = OrderUser::TYPE_SHOP_SHIP;
                }
                $data_order_user_log = [
                    'order_id' => $order_id,
                    'user_id' => $request->user_id,
                    'type' => $type,
                    'status_payment' => OrderUser::UNPAID,
                ];
                $detail_order_log = DetailOrderLog::query()
                    ->leftJoin('detail_item_logs', 'detail_item_logs.detail_order_log_id', 'detail_order_logs.id')
                    ->select('detail_order_logs.*')
                    ->where('detail_order_logs.dish_id', $request->dish_id)
                    ->where('detail_item_logs.item', json_encode($request->item))
                    ->first();
                if($detail_order_log) {
                    $detail_order_log->update(['quantity' => $detail_order_log->quantity + $request->quantity]);
                } else {
                    $order_user_log = OrderUserLog::create($data_order_user_log);
                    $data_detail_order_log = [
                        'order_id' => $order_user_log->order_id,
                        'dish_id' => $request->dish_id,
                        'quantity' => $request->quantity,
                    ];
                    $detail_order_log = DetailOrderLog::create($data_detail_order_log);
                    $menus = Menu::where('dish_id', $request->dish_id)->get();
                    foreach ($menus as $menu) {
                        $data_detail_menu_log = [
                            'detail_order_log_id' => $detail_order_log->id,
                            'menu_id' => $menu->id,
                        ];
                        DetailMenuLog::create($data_detail_menu_log);
                    }
                }
                for ($i = 0; $i < $request->quantity; $i++) {
                    $data_detail_item_log = [
                        'detail_order_log_id' => $detail_order_log->id,
                        'item' => $request->item,
                    ];
                    DetailItemLog::create($data_detail_item_log);
                }
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => OrderUserLog::where('user_id', $request->user_id)->whereNull('status')->get(),
                ]);
            } catch (Exception $e) {
                Log::error('[UserCartController][addCart] error ' . $e->getMessage());
                DB::rollBack();
                dd($e);
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
    public function showCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = Auth::guard('user')->user();
                if ($user) {
                    $data = DetailOrderLog::query()
                        ->leftJoin('order_user_logs', 'order_user_logs.order_id', 'detail_order_logs.order_id')
                        ->leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                        ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'dishes.restaurant_id')
                        ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
                        ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
                        ->select(
                            'detail_order_logs.*',
                            'dishes.name as name',
                            'dishes.name_link as name_link',
                            'dishes.image as image',
                        )
                        ->where('order_user_logs.user_id', $user->id)
                        ->whereNull('order_user_logs.status')
                        ->where('service_types.service_id', $request->service_id)
                        ->orderBy('order_user_logs.updated_at', 'DESC')->limit(4)->get();
                    return response()->json([
                        'code' => 200,
                        'data' => $data,
                    ]);
                }
                return response()->json([
                    'code' => 400,
                ]);
            } catch (Exception $e) {
                Log::error('[UserCartController][addCart] error ' . $e->getMessage());
                dd($e);
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
