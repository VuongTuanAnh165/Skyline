<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderUser extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'order_users';

    protected $guarded = [];

    protected $casts = [
        'promotion_id' => 'array',
        'table_id' => 'array',
        'detail' => 'array',
        'status' => 'array',
    ];

    public $timestamps = true;

    //type: loại của order
    const TYPE_RESTAURANT_EAT = 1; //order bán tại nhà hàng
    const TYPE_RESTAURANT_SHIP = 2; //order nhà hàng online
    const TYPE_RESTAURANT_SET = 3; //order nhà hàng đặt bàn
    const TYPE_SHOP_AT = 4; //order bán tại cửa hàng
    const TYPE_SHOP_SHIP = 5; //order cửa hàng bán online

    //status_payment: trạng thái thanh toán
    const PENDING = 0; //đang chờ thanh toán
    const COMPLETED = 1; //thanh toán thành công
    const UNPAID = 2; //đơn hàng chưa thanh toán
    
    //status: trạng thái order
    const WAIT = 1; //đơn hàng đang chờ xác nhận
    const ORDER_CONFIRMED = 2; //đơn hàng đã đc xác nhận
    const PAY = 3; //đơn hàng đã thanh toán
    const BILLING_INFORMATION = 4; //đơn hàng đã xác nhận thông tin thanh toán
    const RESTAURANT_PREPARE = 5; //nhà hàng đang chuẩn bị món ăn
    const SHOP_PREPARE = 6; // cửa hàng đang chuẩn bị hàng
    const DONE_PREPARE = 7; //đơn hàng đã chuẩn bị xong
    const SHIP = 8; //đơn hàng đang đến chỗ bạn
    const RECEIVE = 9; //đã nhận hàng
    const DONE = 10; //đơn hàng đã hoàn thành

    const STATUS = [
        1 => 'Đơn hàng đang chờ xác nhận',
        2 => 'Đơn hàng đã được xác nhận',
        3 => 'Đơn hàng đã thanh toán',
        4 => 'Đơn hàng đã xác nhận thông tin thanh toán',
        5 => 'Nhà hàng đang chuẩn bị món ăn',
        6 => 'Cửa hàng đang chuẩn bị sản phẩm',
        7 => 'Đơn hàng đã chuẩn bị xong',
        8 => 'Đơn hàng đang đến chỗ bạn',
        9 => 'Đã nhận hàng',
        10 => 'Đơn hàng đã hoàn thành',
    ];
}
