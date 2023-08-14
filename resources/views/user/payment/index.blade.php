@extends('user.layouts.master')
@section('title', 'Thanh toán')
@section('addcss')
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css">
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css"
        type="text/css">
    <style>
        .mapboxgl-ctrl-geocoder input[type='text'] {
            padding: 10px 10px 10px 35px;
        }

        .sum_total_restaurant {
            font-weight: bold;
        }
    </style>
@stop
@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title mb-25">Thanh toán</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ $url_home }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Thanh toán</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->
    <!-- Start checkout page area -->
    <section class="checkout__page--area">
        <div class="container">
            <div class="checkout__page--inner d-flex">
                <div class="main checkout__mian">
                    <main class="main__content_wrapper section--padding pt-0">
                        <form action="#">
                            <div class="section__header mb-25">
                                <h2 class="section__header--title h3">Thông tin người nhận</h2>
                            </div>
                            <div class="checkout__content--step checkout__contact--information2 border-radius-5">
                                <div class="checkout__review d-flex justify-content-between align-items-center">
                                    <div class="checkout__review--inner d-flex align-items-center">
                                        <label class="checkout__review--label">Tên</label>
                                        <input class="checkout__review--content" id="user_name" name="name" disabled
                                            value="{{ $user->name }}">
                                    </div>
                                    <div class="checkout__review--link">
                                        <button class="checkout__review--link__text btn-edit" type="button">Sửa</button>
                                        <button class="checkout__review--link__text btn-save display-none"
                                            type="button">Lưu</button>
                                    </div>
                                </div>
                                <div class="checkout__review d-flex justify-content-between align-items-center">
                                    <div class="checkout__review--inner d-flex align-items-center">
                                        <label class="checkout__review--label">Email</label>
                                        <input class="checkout__review--content" id="user_email" name="email" disabled
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="checkout__review--link">
                                        <button class="checkout__review--link__text btn-edit" type="button">Sửa</button>
                                        <button class="checkout__review--link__text btn-save display-none"
                                            type="button">Lưu</button>
                                    </div>
                                </div>
                                <div class="checkout__review d-flex justify-content-between align-items-center">
                                    <div class="checkout__review--inner d-flex align-items-center">
                                        <label class="checkout__review--label">Phone</label>
                                        <input class="checkout__review--content" id="user_phone" name="phone" disabled
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="checkout__review--link">
                                        <button class="checkout__review--link__text btn-edit" type="button">Sửa</button>
                                        <button class="checkout__review--link__text btn-save display-none"
                                            type="button">Lưu</button>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__content--step section__shipping--address">
                                <div class="section__header mb-25">
                                    <h2 class="section__header--title h3">Địa chỉ nhận hàng</h2>
                                    <p class="section__header--desc">Chọn địa chỉ phù hợp phù hợp với bạn.</p>
                                </div>
                                <div class="checkout__content--step__inner3 border-radius-5">
                                    <div class="checkout__address--content__header bg__primary2">
                                        <div class="shipping__contact--box__list">
                                            <div class="shipping__radio--input">
                                                <input class="shipping__radio--input__field" value="1" id="radiobox"
                                                    checked name="checkmethod" type="radio">
                                            </div>
                                            <label class="shipping__radio--label" for="radiobox">
                                                <span class="shipping__radio--label__primary">Chọn địa chỉ có sẵn</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="checkout__content--input__box--wrapper radiobox-div">
                                        <div class="row">
                                            <div class="col-lg-12 mb-12">
                                                <div class="checkout__input--list checkout__input--select select">
                                                    <label class="checkout__select--label" for="country">Chọn địa
                                                        chỉ</label>
                                                    <select id="available_address"
                                                        class="checkout__input--select__field border-radius-5">
                                                        @if (count($address) > 0)
                                                            @foreach ($address as $item)
                                                                <option data-address="{{ $item->address }}"
                                                                    value="{{ $item->id }}"
                                                                    {{ $item->status == 1 ? 'selected' : '' }}>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">Không có</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input disabled class="checkout__input--field border-radius-5"
                                                            placeholder="Địa điểm" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout__address--content__header border-0 bg__primary2">
                                        <div class="shipping__contact--box__list">
                                            <div class="shipping__radio--input">
                                                <input class="shipping__radio--input__field" value="2" id="radiobox2"
                                                    name="checkmethod" type="radio">
                                            </div>
                                            <label class="shipping__radio--label" for="radiobox2">
                                                <span class="shipping__radio--label__primary">Chọn địa chỉ mới</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="checkout__content--input__box--wrapper radiobox2-div display-none">
                                        <div class="row">
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Tên" type="text" id="user_address_name">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Kinh độ" id="longitude" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Vĩ độ" id="latitude" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div wire:ignore id="map" style='width: 100%; height: 30vh;'></div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Địa chỉ đầy đủ" id="address" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </main>
                </div>
                <aside class="checkout__sidebar sidebar">
                    <div class="cart__table checkout__product--table">
                        @foreach ($order_user_logs as $order_user_log)
                            <table class="cart__table--inner">
                                <tbody class="cart__table--body">
                                    <input type="hidden" class="order_user_log_order_id"
                                        value="{{ $order_user_log->order_id }}">
                                    <tr class="cart__table--body__items">
                                        <td colspan="2" class="table-restaurant-name">
                                            <b>{{ $order_user_log->restaurant_name }}</b>
                                        </td>
                                    </tr>
                                    @php
                                        $detail_order_logs = \App\Models\DetailOrderLog::leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                                            ->select('detail_order_logs.*', 'dishes.id as dish_id', 'dishes.name_link as name_link', 'dishes.name as dish_name', 'dishes.price as dish_price', 'dishes.image as dish_image')
                                            ->where('detail_order_logs.order_id', $order_user_log->order_id)
                                            ->whereIn('detail_order_logs.id', $arr_detail_order_log_id)
                                            ->get();
                                    @endphp
                                    @foreach ($detail_order_logs as $detail_order_log)
                                        <input type="hidden" class="detail_order_log_id"
                                            value="{{ $detail_order_log->id }}">
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="product__image two  d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a href="product-details.html"><img class="border-radius-5"
                                                                src="{{ !empty($detail_order_log->dish_image) ? asset('storage/' . json_decode($detail_order_log->dish_image, true)[0]) : asset('img/background_default.jpg') }}"
                                                                alt="cart-product"></a>
                                                        <span
                                                            class="product__thumbnail--quantity">{{ $detail_order_log->quantity }}</span>
                                                        <input class="quickview__value--number" type="hidden"
                                                            value="{{ $detail_order_log->quantity }}">
                                                    </div>
                                                    <div class="product__description">
                                                        <h3 class="product__description--name h4">
                                                            <a
                                                                href="product-details.html">{{ $detail_order_log->dish_name }}</a>
                                                        </h3>
                                                        <span class="product__description--variant">Chi nhánh số: {{ $order_user_log->branch_name }}</span>
                                                        <span class="product__description--variant">({{ $order_user_log->branch_address }})</span>
                                                        <input type="hidden" class="value_price"
                                                            value="{{ $detail_order_log->dish_price }}">
                                                        @php
                                                            $detail_item_logs = \App\Models\DetailItemLog::where('detail_order_log_id', $detail_order_log->id)
                                                                ->groupBy('item')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($detail_item_logs as $detail_item_log)
                                                            @if (!empty($detail_item_log->item))
                                                                @foreach ($detail_item_log->item as $item)
                                                                    @php
                                                                        $menu = App\Models\Menu::select('name')
                                                                            ->where('id', $item[0])
                                                                            ->first();
                                                                    @endphp
                                                                    <div class="cart__price">
                                                                        <span class="product__description--variant">
                                                                            {{ $menu->name }}:
                                                                        </span>
                                                                        @if (is_array($item[1]))
                                                                            @foreach ($item[1] as $value)
                                                                                @php
                                                                                    $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                        ->where('id', $value)
                                                                                        ->first();
                                                                                @endphp
                                                                                @if ($menu_item)
                                                                                    <span
                                                                                        class="product__description--variant">
                                                                                        {{ $menu_item->name }}
                                                                                        @if ($menu_item->add_price != 0)
                                                                                            <span>
                                                                                                (+
                                                                                                {{ number_format($menu_item->add_price) }}
                                                                                                VND)
                                                                                            </span>
                                                                                        @endif
                                                                                        <input type="hidden"
                                                                                            class="value_price"
                                                                                            value="{{ $menu_item->add_price }}">
                                                                                    </span>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            @php
                                                                                $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                    ->where('id', $value)
                                                                                    ->first();
                                                                            @endphp
                                                                            @if ($menu_item)
                                                                                <span
                                                                                    class="product__description--variant">
                                                                                    {{ $menu_item->name }}
                                                                                    @if ($menu_item->add_price !=0)
                                                                                        <span>
                                                                                            (+
                                                                                            {{ number_format($menu_item->add_price) }}
                                                                                            VND)
                                                                                        </span>
                                                                                    @endif
                                                                                    <input type="hidden"
                                                                                        class="value_price"
                                                                                        value="{{ $menu_item->add_price }}">
                                                                                </span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price end"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @php
                                        $promotion_restaurants = \App\Models\Promotion::where('restaurant_id', $order_user_log->restaurant_id)
                                            ->whereDate('started_at', '<=', $today)
                                            ->whereDate('ended_at', '>=', $today)
                                            ->get();
                                    @endphp
                                    @if (count($promotion_restaurants) > 0)
                                        <tr class="cart__table--body__items checkout__discount--code promotion-restaurant">
                                            <td colspan="2" class="cart__table--body__list">
                                                <form class="d-flex" action="#">
                                                    <label style="width: 100%;">
                                                        <select
                                                            class="checkout__discount--code__input--field border-radius-5">
                                                            <option value="">Khuyến mãi {{ $title }}</option>
                                                            @foreach ($promotion_restaurants as $promotion_restaurant)
                                                                <option value="{{ $promotion_restaurant->id }}"
                                                                    data-condition="{{ $promotion_restaurant->condition }}"
                                                                    data-value="{{ $promotion_restaurant->value }}">
                                                                    {{ $promotion_restaurant->name }}
                                                                    (Điều kiện
                                                                    {{ number_format($promotion_restaurant->condition) }}
                                                                    VND - Giảm {{ $promotion_restaurant->value }} VND)
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                    <button style="min-width: 110px;"
                                                        class="checkout__discount--code__btn btn border-radius-5"
                                                        type="button">Áp dụng</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="cart__table--body__items checkout__discount--code promotion-skyline">
                                        <td colspan="2" class="cart__table--body__list">
                                            <form class="d-flex" action="#">
                                                <label style="width: 100%;">
                                                    <select class="checkout__discount--code__input--field border-radius-5">
                                                        <option value="">Khuyến mãi từ Sky line</option>
                                                        @foreach ($promotion_skylines as $promotion_skyline)
                                                            <option value="{{ $promotion_skyline->id }}"
                                                                data-condition="{{ $promotion_skyline->condition }}"
                                                                data-value="{{ $promotion_skyline->value }}">
                                                                {{ $promotion_skyline->name }}
                                                                (Điều kiện
                                                                {{ number_format($promotion_skyline->condition) }} VND -
                                                                Giảm {{ $promotion_skyline->value }} VND)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <button style="min-width: 110px;"
                                                    class="checkout__discount--code__btn btn border-radius-5"
                                                    type="button">Áp dụng</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="cart__table--body__items">
                                        <td class="cart__table--body__list text-center">
                                            <p class="product__description--name h4">Tổng</p>
                                        </td>
                                        <td class="cart__table--body__list sum_total_restaurant"></td>
                                    </tr>
                                    <tr class="cart__table--body__items">
                                        <td class="cart__table--body__list text-center">Vận chuyển</td>
                                        <td class="cart__table--body__list shipping" data-price="30000">
                                            +30.000 VND</td>
                                    </tr>
                                    <tr class="cart__table--body__items tr-discount d-none">
                                        <td class="cart__table--body__list text-center">
                                            <p class="product__description--name h4">Khuyến mãi {{ $title }}</p>
                                        </td>
                                        <td class="cart__table--body__list current__price"></td>
                                    </tr>
                                    <tr class="cart__table--body__items tr-discount-skyline d-none">
                                        <td class="cart__table--body__list text-center">
                                            <p class="product__description--name h4">Khuyến mãi từ Sky line</p>
                                        </td>
                                        <td class="cart__table--body__list current__price"></td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                    <div class="checkout__total">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                            </tbody>
                            <tfoot class="checkout__total--footer">
                                <tr class="checkout__total--footer__items">
                                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                                        Thành tiền </td>
                                    <td
                                        class="checkout__total--footer__amount checkout__total--footer__list text-right into-money">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="checkout__content--step section__shipping--address">
                        <div class="section__header mb-3">
                            <h2 class="section__header--title h3">Phương thức thanh toán</h2>
                            <p class="section__header--desc">Thông tin thanh toán đều được bảo mật</p>
                        </div>
                        <div
                            class="checkout__content--step__footer d-flex align-items-center mb-3 justify-content-between">
                            <button class="continue__shipping--btn btn border-radius-5 pay-off">Thanh toán khi nhận
                                hàng</button>
                            <button class="continue__shipping--btn btn border-radius-5 pay-onl bg__primary2">Thanh toán
                                online</button>
                            <input type="hidden" id="url-my-account" value="{{ $url_account }}">
                        </div>
                        <div class="checkout__content--step__inner3 border-radius-5 d-none checkout-paypal">
                            <div
                                class="checkout__address--content__header d-flex align-items-center justify-content-between bg__primary">
                                <span class="checkout__address--content__title">Pay Pal</span>
                                <span class="heckout__address--content__icon"><img width="20px"
                                        src="{{ asset('img/paypal_icon.png') }}" alt="card"></span>
                            </div>
                            <div class="checkout__content--input__box--wrapper ">
                                <div id="paypal-button-container"></div>
                                <button class="btn border-radius-5 paypal-close" type="button">Đóng</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-5 float-end">
                        <a class="previous__link--content float-end" href="cart.html">Quay về giỏ hàng</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- End checkout page area -->
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('user.partials.script.toastr')
    @endif
    @include('user.payment.script')
    @include('restaurant.admin.branch.script_map')
@stop
