<?php

namespace App\Http\Controllers\Paypal;

use App\Helpers\PayPalHelper;
use App\Helpers\UploadsHelper;
use App\Helpers\UsdPriceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paypal\CreateCeoRequest;
use App\Jobs\Ceo\SendEmailCeoCreate;
use App\Models\DetailItemLog;
use App\Models\DetailMenuLog;
use App\Models\DetailOrderLog;
use App\Models\OrderCeo;
use App\Models\OrderCeoLog;
use App\Models\OrderUser;
use App\Models\OrderUserLog;
use App\Models\PayPalLog;
use App\Models\Restaurant;
use App\Models\ServiceCharge;
use App\Models\Skyline;
use App\Models\UserAddress;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;

class PaypalPaymentController extends Controller
{
    //Thanh toán cho chủ nhà hàng đăng ký dịch vụ
    public function createCeo(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $skyline = Skyline::first();
        $config_paypal = PayPalHelper::paypal($skyline->client_id, $skyline->secret);
        $paypalClient = new PayPalClient;

        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $order = $paypalClient->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => UsdPriceHelper::usdPrice($data['total'])
                    ],
                    'description' => 'test'
                ]
            ],
        ]);
        DB::beginTransaction();
        try {
            $dataOrderCeoLog = [
                'order_id' => $data['order_id'],
                'ceo_id' => $data['ceo_id'],
                'service_charge_id' => $data['service_charge_id'],
                'type' => $data['type'],
                'implementation_date' => $data['implementation_date'],
                'promotion_id' => $data['promotion_id'],
                'subtotal' => $data['subtotal'],
                'total' => $data['total'],
                'status' => OrderCeo::PENDING,
                'vendor_order_id' => $order['id'],
                'email' => $data['email'],
            ];
            $orderCeoLog = OrderCeoLog::create($dataOrderCeoLog);
            DB::commit();
            return response()->json($order);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function captureCeo(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];
        $skyline = Skyline::first();
        $config_paypal = PayPalHelper::paypal($skyline->client_id, $skyline->secret);
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $result = $paypalClient->capturePaymentOrder($orderId);

        DB::beginTransaction();
        try {
            if ($result['status'] === "COMPLETED") {
                $orderCeoLog = OrderCeoLog::where('vendor_order_id', $orderId)->first();
                $orderCeoLog->update(['status' => OrderCeo::COMPLETED]);

                $dataRestaurant = [
                    'email' => $orderCeoLog['email'],
                    'ceo_id' => $orderCeoLog['ceo_id'],
                ];
                $random = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 10))), 1, 10);
                $dataRestaurant['password'] = Hash::make($random);
                dispatch(new SendEmailCeoCreate($orderCeoLog, $data['email'], $random));
                $restaurant = Restaurant::create($dataRestaurant);

                $dataOrderCeo = [
                    'order_id' => $orderCeoLog['order_id'],
                    'ceo_id' => $orderCeoLog['ceo_id'],
                    'service_charge_id' => $orderCeoLog['service_charge_id'],
                    'type' => $orderCeoLog['type'],
                    'implementation_date' => $orderCeoLog['implementation_date'],
                    'promotion_id' => $orderCeoLog['promotion_id'],
                    'subtotal' => $orderCeoLog['subtotal'],
                    'total' => $orderCeoLog['total'],
                    'status' => $orderCeoLog['status'],
                    'vendor_order_id' => $orderCeoLog['vendor_order_id'],
                    'restaurant_id' => $restaurant['id'],
                    'password' => $random,
                ];
                $orderCeo = OrderCeo::create($dataOrderCeo);

                $service_charge = ServiceCharge::find($orderCeo->service_charge_id);
                $started_at = Carbon::parse($orderCeo->implementation_date);
                $ended_at = Carbon::parse($orderCeo->implementation_date)->addMonths($service_charge->month);
                Restaurant::find($orderCeo->restaurant_id)->update([
                    'started_at' => $started_at->toDateTimeString(),
                    'ended_at' => $ended_at->toDateTimeString(),
                ]);
                OrderCeoLog::query()->delete();
                DB::commit();
            }
            return response()->json($result);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }

    //Thanh toán user
    public function createUser(Request $request)
    {
        $skyline = Skyline::first();
        $config_paypal = PayPalHelper::paypal($skyline->client_id, $skyline->secret);
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $carts = json_decode($request->cart, true);
        $total = 0;
        foreach ($carts as  $cart) {
            $total += $cart['total_money'];
        }
        $order = $paypalClient->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => UsdPriceHelper::usdPrice($total)
                    ],
                    'description' => 'test'
                ]
            ],
        ]);
        DB::beginTransaction();
        try {
            $dataPayPalLog = [
                'vendor_order_id' => $order['id'],
                'data' => $request->all(),
                'status_payment' => OrderUser::PENDING,
            ];
            $pay_pal_log = PayPalLog::create($dataPayPalLog);
            DB::commit();
            return response()->json($order);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function captureUser(Request $request)
    {
        $datas = json_decode($request->getContent(), true);
        $orderId = $datas['orderId'];
        $skyline = Skyline::first();
        $config_paypal = PayPalHelper::paypal($skyline->client_id, $skyline->secret);
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $result = $paypalClient->capturePaymentOrder($orderId);

        DB::beginTransaction();
        try {
            if ($result['status'] === "COMPLETED") {
                $payPalLog = PayPalLog::where('vendor_order_id', $orderId)->first();
                $payPalLog->update(['status_payment' => OrderUser::COMPLETED]);
                $params = $payPalLog['data'];
                $user_address_id = '';
                if ($params['type_ship'] == 1) {
                    $user_address_id == $params['available_address'];
                } else {
                    $data_user_addres = [
                        'name' => $params['user_address_name'],
                        'longitude' => $params['longitude'],
                        'latitude' => $params['latitude'],
                        'address' => $params['address'],
                        'status' => 1,
                        'user_id' => $params['user_id'],
                    ];
                    $user_address_id = UserAddress::create($data_user_addres)->id;
                }
                $carts = json_decode($params['cart'], true);
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
                    $param_order_user = [
                        'order_id' => $order_id,
                        'total_money' => $cart['total_money'],
                        'status_payment' => $payPalLog['status_payment'],
                        'status' => $status,
                        'type' => $data->type,
                        'restaurant_id' => $data->restaurant_id,
                        'promotion_id' => $promotion_id,
                        'implementation_date' => Carbon::now()->toDateTimeString(),
                        'vendor_order_id' => $payPalLog['vendor_order_id'],
                        'user_id' => $params['user_id'],
                        'user_address_id' => $user_address_id,
                        'detail' => $detail,
                    ];
                    DetailOrderLog::whereIn('id', $detail_order_log_id)->delete();
                    DetailMenuLog::whereIn('detail_order_log_id', $detail_order_log_id)->delete();
                    DetailItemLog::whereIn('detail_order_log_id', $detail_order_log_id)->delete();
                    $check_detail_log = DetailOrderLog::where('order_id', $cart['order_id'])->first();
                    if (empty($check_detail_log)) {
                        OrderUserLog::where('order_id', $cart['order_id'])->delete();
                    }
                    PayPalLog::where('vendor_order_id', $orderId)->delete();
                    $order_user = OrderUser::create($param_order_user);
                }
                DB::commit();
            }
            return response()->json($result);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }
}
