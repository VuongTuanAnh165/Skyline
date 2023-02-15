@extends('restaurant.sell.layouts.master')
@section('title', 'Thanh toán' )
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_sell/eat/style.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@stop
@section('content')
<div class="container-header row">
    <a href="" class="col-md-6 alert alert-danger header-a">
        Tạo hóa đơn
    </a>
    <a href="" class="col-md-6 alert alert-secondary header-a">
        Hóa đơn
    </a>
</div>
<div style="padding-top: 55px;" class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin hóa đơn</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mã hóa đơn: {{$order_user_log->order_id}}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="">
                                    <p class="mb-1 text-danger">Bàn:</p>
                                    <ul class="mb-0 font-weight-bold text-dark">
                                        @foreach($order_user_log->table_id as $value)
                                            @php 
                                                $tables = App\Models\Table::select('name')->where('id', $value)->first();
                                            @endphp
                                            <li>Bàn số: {{ $tables->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="details-page border-top pt-3">
                                <h6 class="mb-3 text-danger">Chi tiết hóa đơn</h6>
                                @foreach($detail_order_logs as $detail_order_log)
                                    <div class="d-flex align-items-center">
                                        <p class="bg-light rounded px-2 mr-3">{{ $detail_order_log->quantity }}</p>
                                        <p class="text-dark">{{ $detail_order_log->dish_name }} ({{ number_format($detail_order_log->dish_price) }} VND)</p>
                                        <p class="ml-auto text-dark">{{ number_format($detail_order_log->quantity * $detail_order_log->dish_price) }} VND</p>
                                        <input type="hidden" class="value_price" value="{{ $detail_order_log->quantity * $detail_order_log->dish_price }}">
                                    </div>
                                    @php 
                                        $detail_item_logs = App\Models\DetailItemLog::where('detail_order_log_id', $detail_order_log->id)->get();
                                    @endphp
                                    @if(count($detail_item_logs) > 0)
                                    <ul>
                                        @foreach($detail_item_logs as $detail_item_log)
                                            <li>
                                            @foreach($detail_item_log->item as $item)
                                                @php
                                                    $menu = App\Models\Menu::select('name')->where('id', $item[0])->first();
                                                @endphp
                                                <div>
                                                    {{$menu->name}}:
                                                    @foreach($item[1] as $value)
                                                        @php
                                                            $menu_item = App\Models\MenuItem::select('name', 'add_price')->where('id', $value)->first();
                                                        @endphp
                                                        @if($menu_item)
                                                            <span>
                                                                <ul>
                                                                    <li>
                                                                        {{ $menu_item->name }}
                                                                        <span style="float:right;"> + {{ number_format($menu_item->add_price) }} VND</span>
                                                                        <input type="hidden" class="value_price" value="{{ $menu_item->add_price }}">
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        @else
                                                            <span>Không có</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <div class="d-flex align-items-center py-2 border-top">
                                    <p class="text-dark font-weight-bold m-0">Tổng tiền</p>
                                    <p id="p_sub_total" class="ml-auto text-danger m-0"></p>
                                    <input type="hidden" id="sub_total" value="">
                                </div>
                                <div class="div_promotion">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <div class="row w-100">
                                <div class="col-3 px-0"><a href="javascript:void(0)" class="btn btn-warning btn-block">Thành tiền</a></div>
                                <div class="col-9 pr-0"><a href="javascript:void(0)" id="a_into_money" class="btn btn-primary btn-block"></a></div>
                                <input type="hidden" id="into_money" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chương trình khuyến mãi (nếu có)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-body">
                            <div>
                                <div class="osahan-card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group" style="margin:0;">
                                                <label class="form-label small font-weight-bold">Chương trình khuyến mãi</label><br>
                                                <select class="custom-select form-control select2" id="promotion_id" name="promotion_id[]" multiple>
                                                    @foreach($promotions as $promotion)
                                                        <option data-promotion_condition="{{$promotion->condition}}" data-promotion_value="{{$promotion->value}}" value="{{ $promotion->id }}">
                                                            {{ $promotion->name }} - điều kiện: > {{number_format($promotion->condition)}} VND <span>( Trị giá: {{number_format($promotion->value)}} VND )</span> 
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-url="{{route('sell.restaurant.eat.addPromotion', ['order_id' => $order_user_log->order_id])}}" id="btn_add_promotion" class="btn btn-primary btn-block">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hình thức thanh toán</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-footer justify-content-start">
                            <div class="row w-100">
                                <div class="col-6 px-0"><a href="javascript:void(0)" id="btn_payments_onl" class="btn btn-warning btn-block">Thanh toán chuyển khoản</a></div>
                                <div class="col-6 pr-0"><a href="javascript:void(0)" id="btn_payments_off" class="btn btn-primary btn-block">Thanh toán tiền mặt</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 payments_off display-none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tiền nhận</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body">
                                    <div class="osahan-card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-md-12 form-group" style="margin:0;">
                                                    <label class="form-label font-weight-bold small">Tiền nhận</label>
                                                    <div class="input-group">
                                                        <input placeholder="Tiền nhận" type="text" id="input_payment" class="form-control">
                                                        <div class="input-group-append"><button id="button-addon2" type="button" class="btn btn-outline-secondary">VND
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn_payment" class="btn btn-primary btn-block">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 payments_off display-none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary exchange">Tiền trả lại</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body">
                                    <div class="osahan-card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-md-12 form-group" style="margin:0;">
                                                    <label class="form-label font-weight-bold small exchange">Tiền trả lại</label>
                                                    <div class="input-group">
                                                        <input placeholder="Tiền trả lại" disabled value="0" type="text" id="exchange" class="form-control">
                                                        <div class="input-group-append">
                                                            <button id="button-addon2" type="button" class="btn btn-outline-secondary" disabled>
                                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 payments_off display-none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Xác nhận thanh toán tiền mặt</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-footer">
                                    <button type="button" id="btn_payment_off_sussces" data-url="{{ route('sell.restaurant.eat.pay', ['order_id' => $order_user_log->order_id]) }}" disabled class="btn btn-primary btn-block">Thanh toán thành công</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 payments_onl display-none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Xác nhận thanh toán chuyển khoản</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-footer">
                                    <button type="button" id="btn_payment_onl_sussces" data-url="{{ route('sell.restaurant.eat.pay', ['order_id' => $order_user_log->order_id]) }}" class="btn btn-warning btn-block">Thanh toán thành công</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif
@include('restaurant.sell.restaurant.eat.script_payment')
@stop