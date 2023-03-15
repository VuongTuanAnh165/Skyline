@extends('restaurant.sell.layouts.master')
@section('title', 'Ăn tại quán' )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_sell/eat/style.css') }}">
@stop
@section('content')
<div class="container-header row">
    <a href="{{ route('sell.restaurant.eat.index') }}" class="col-md-6 alert alert-danger header-a">
        Tạo hóa đơn
    </a>
    <a href="{{ route('sell.restaurant.eat.order') }}" class="col-md-6 alert alert-secondary header-a">
        Hóa đơn
    </a>
</div>
<div style="padding-top: 55px;" class="container-fluid">
    <div class="row">
        @php
            $order_user_log_all = \App\Models\OrderUserLog::where('type',\App\Models\OrderUser::TYPE_RESTAURANT_EAT)->get();
        @endphp
        @foreach($tables as $table)
            @php
                $choose_disabled = 'disabled';
                $url = "javascript:void(0)";
                foreach ($order_user_log_all as $item) {
                    if (in_array($table->id, $item->table_id)) {
                        $url = route('sell.restaurant.eat.payment', ['order_id' => $item->order_id]);
                        foreach($item->status as $value) {
                            if($value[0] == 7) {
                                $choose_disabled = '';
                                break;
                            }
                        }
                    }
                }
            @endphp
            <div class="text-decoration-none col-xl-3 col-md-4 mb-4">
                <div class="rounded py-4 bg-white shadow-sm text-center">
                    <div class="menu-table text-primary">
                        <h6 style="font-weight: 700;" class="mt-0 mb-0">Bàn số: {{ $table->name }}</h6>
                        <p class="mb-0 small">Số người tối đa: {{ $table->max_people }}</p>
                    </div>
                    <img src="{{ asset('img/logo_table.png') }}" class="img-table {{ $table->status == 1 ? 'disabled' : '' }}">
                    <div class="menu-table">
                        <a href="javascript:void(0)" data-url="{{ route('sell.restaurant.eat.create', ['table_id' => $table->id]) }}" class="{{ $table->status == 1 ? 'display-none' : '' }} create-order"><button class="btn btn-success">Đặt món</button></a>
                        <a href="{{ route('sell.restaurant.eat.edit', ['table_id' => $table->id]) }}" class="{{ $table->status == 0 ? 'display-none' : '' }}"><button class="btn btn-info">Chi tiết</button></a>
                        <a href="{{$url}}"><button class="btn btn-danger" {{$choose_disabled}}>Thanh toán</button></a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12 text-right">
            {{ $tables->links() }}
        </div>
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif
@include('restaurant.sell.restaurant.eat.script')
@stop