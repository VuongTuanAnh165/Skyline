<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailItemLog;
use App\Models\DetailMenuLog;
use App\Models\DetailOrderLog;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
use App\Models\UserAddress;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserPaymentController extends Controller
{
    protected $pathView = 'user.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $user_address_id = '';
                if ($request->type_ship == 1) {
                    $user_address_id == $request->available_address;
                } else {
                    $data_user_addres = [
                        'name' => $request->user_address_name,
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'address' => $request->address,
                        'status' => 1,
                        'user_id' => $request->user_id,
                    ];
                    $user_address_id = UserAddress::create($data_user_addres)->id;
                }
                $carts = json_decode($request->cart, true);
                foreach ($carts as $cart) {
                    $data = OrderUserLog::where('order_id', $cart['order_id'])->first();
                    $status = $data->status ?? [];
                    $status_new = [
                        OrderUser::WAIT,
                        Carbon::now()->toDateTimeString(),
                    ];
                    array_push($status, $status_new);
                    $detail_order_log_id = explode('-', $cart['detail_order_log_id']);
                    $detail_order = DetailOrderLog::whereIn('id', $detail_order_log_id)->get();
                    $detail = [];
                    foreach ($detail_order as $value_order) {
                        $detail_item = DetailItemLog::where('detail_order_log_id', $value_order->id)->get();
                        $item = [];
                        foreach ($detail_item as $value_item) {
                            array_push($item, $value_item->item);
                        }
                        $dish = [
                            $value_order->dish_id,
                            $value_order->quantity,
                            $item
                        ];
                        array_push($detail, $dish);
                    }
                    $nowDate = Carbon::now();
                    $str = str_replace('-', '', $nowDate->toDateTimeString());
                    $str = str_replace(':', '', $str);
                    $str = str_replace(' ', '', $str);
                    $order_id = Str::random(5) . '_' . $str;
                    $promotion_id = explode('-', $cart['promotion_id']);
                    $params = [
                        'order_id' => $order_id,
                        'total_money' => $cart['total_money'],
                        'status_payment' => OrderUser::UNPAID,
                        'status' => $status,
                        'type' => $data->type,
                        'restaurant_id' => $data->restaurant_id,
                        'promotion_id' => $promotion_id,
                        'implementation_date' => Carbon::now()->toDateTimeString(),
                        'user_address_id' => $user_address_id,
                        'user_id' => $request->user_id,
                        'detail' => $detail,
                    ];
                    DetailOrderLog::whereIn('id', $detail_order_log_id)->delete();
                    DetailMenuLog::whereIn('detail_order_log_id', $detail_order_log_id)->delete();
                    DetailItemLog::whereIn('detail_order_log_id', $detail_order_log_id)->delete();
                    $check_detail_log = DetailOrderLog::where('order_id', $cart['order_id'])->first();
                    if(empty($check_detail_log)) {
                        OrderUserLog::where('order_id', $cart['order_id'])->delete();
                    }
                    $order_user = OrderUser::create($params);
                }
                DB::commit();
                return response()->json([
                    'code' => 200,
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
}
