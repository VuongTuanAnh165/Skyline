<?php

namespace App\Http\Controllers\Paypal;

use App\Helpers\PayPalHelper;
use App\Helpers\UploadsHelper;
use App\Helpers\UsdPriceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paypal\CreateCeoRequest;
use App\Jobs\Ceo\SendEmailCeoCreate;
use App\Models\OrderCeo;
use App\Models\OrderCeoLog;
use App\Models\Restaurant;
use App\Models\ServiceCharge;
use App\Models\Skyline;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

        try {
            DB::beginTransaction();
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
}
