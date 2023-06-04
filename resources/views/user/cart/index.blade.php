@extends('user.layouts.master')
@section('title', 'Giỏ hàng')
@section('addcss')

@stop
@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title mb-25">Giỏ hàng</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ $url_home }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Giỏ hàng</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- cart section start -->
    <section class="cart__section section--padding">
        <div class="container-fluid">
            <div class="cart__section--inner">
                @if (count($order_user_logs) > 0)
                    @foreach ($order_user_logs as $order_user_log)
                        <div class="cart-restaurant mb-60">
                            <div class="title-product d-flex align-items-center mb-40">
                                <h2 class="cart__title mr-4">{{ $order_user_log->restaurant_name }}</h2>
                                <div class="checkbox-rect">
                                    <input type="checkbox" id="checkbox-all-{{ $order_user_log->id }}" class="checkbox-all"
                                        name="check">
                                    <label for="checkbox-all-{{ $order_user_log->id }}" class="">Chọn hết</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart__table">
                                        <table class="cart__table--inner">
                                            <thead class="cart__table--header">
                                                <tr class="cart__table--header__items">
                                                    <th class="cart__table--header__list">{{ $title_product }}</th>
                                                    <th class="cart__table--header__list">Phân loại</th>
                                                    <th class="cart__table--header__list">Số lượng</th>
                                                    <th class="cart__table--header__list">Tổng cộng</th>
                                                    <th class="cart__table--header__list"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="cart__table--body">
                                                @php
                                                    $detail_order_logs = \App\Models\DetailOrderLog::leftJoin('dishes', 'dishes.id', 'detail_order_logs.dish_id')
                                                        ->select('detail_order_logs.*', 'dishes.id as dish_id', 'dishes.name_link as name_link', 'dishes.name as dish_name', 'dishes.price as dish_price', 'dishes.image as dish_image')
                                                        ->where('detail_order_logs.order_id', $order_user_log->order_id)
                                                        ->get();
                                                @endphp
                                                @foreach ($detail_order_logs as $detail_order_log)
                                                    <tr
                                                        class="cart__table--body__items cart__table--body__items-{{ $detail_order_log->id }}">
                                                        <input type="hidden" class="detail_order_log_id"
                                                            value="{{ $detail_order_log->id }}">
                                                        <td class="cart__table--body__list">
                                                            <div class="cart__product d-flex align-items-center">
                                                                <button class="cart__remove--btn" aria-label="search button"
                                                                    type="button">
                                                                    <svg fill="currentColor"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="16px" height="16px">
                                                                        <path
                                                                            d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                                                    </svg>
                                                                </button>
                                                                <div class="cart__thumbnail">
                                                                    <a
                                                                        href="{{ route($url_show, ['id' => $detail_order_log->dish_id, 'name_link' => $detail_order_log->name_link, 'code' => $detail_order_log->id]) }}">
                                                                        <img class="border-radius-5"
                                                                            src="{{ !empty($detail_order_log->dish_image) ? asset('storage/' . json_decode($detail_order_log->dish_image, true)[0]) : asset('img/background_default.jpg') }}"
                                                                            alt="cart-product">
                                                                    </a>
                                                                </div>
                                                                <div class="cart__content">
                                                                    <h3 class="cart__content--title h4"><a
                                                                            href="{{ route($url_show, ['id' => $detail_order_log->dish_id, 'name_link' => $detail_order_log->name_link, 'code' => $detail_order_log->id]) }}">{{ $detail_order_log->dish_name }}</a>
                                                                    </h3>
                                                                    <span class="cart__content--variant">Giá: <span
                                                                            class="cart__price">{{ number_format($detail_order_log->dish_price) }}
                                                                            VND</span></span>
                                                                    <input type="hidden" class="value_price"
                                                                        value="{{ $detail_order_log->dish_price }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cart__table--body__list">
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
                                                                            <h3 class="cart__content--title h4">
                                                                                {{ $menu->name }}: </h3>
                                                                            @if (is_array($item[1]))
                                                                                @foreach ($item[1] as $value)
                                                                                    @php
                                                                                        $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                            ->where('id', $value)
                                                                                            ->first();
                                                                                    @endphp
                                                                                    @if ($menu_item)
                                                                                        <span
                                                                                            class="cart__content--variant cart__content">
                                                                                            <ul>
                                                                                                <li>
                                                                                                    {{ $menu_item->name }}:
                                                                                                    <span
                                                                                                        class="cart__price">
                                                                                                        +
                                                                                                        {{ number_format($menu_item->add_price) }}
                                                                                                        VND</span>
                                                                                                    <input type="hidden"
                                                                                                        class="value_price"
                                                                                                        value="{{ $menu_item->add_price }}">
                                                                                                </li>
                                                                                            </ul>
                                                                                        </span>
                                                                                    @else
                                                                                        <span
                                                                                            class="cart__content--variant cart__content">Không
                                                                                            có</span>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                @php
                                                                                    $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                        ->where('id', $item[1])
                                                                                        ->first();
                                                                                @endphp
                                                                                @if ($menu_item)
                                                                                    <span
                                                                                        class="cart__content--variant cart__content">
                                                                                        <ul>
                                                                                            <li>
                                                                                                {{ $menu_item->name }}:
                                                                                                <span class="cart__price"> +
                                                                                                    {{ number_format($menu_item->add_price) }}
                                                                                                    VND</span>
                                                                                                <input type="hidden"
                                                                                                    class="value_price"
                                                                                                    value="{{ $menu_item->add_price }}">
                                                                                            </li>
                                                                                        </ul>
                                                                                    </span>
                                                                                @else
                                                                                    <span
                                                                                        class="cart__content--variant cart__content">Không
                                                                                        có</span>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="cart__price">Không có</div>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="cart__table--body__list">
                                                            <div class="quantity__box">
                                                                <button type="button"
                                                                    class="quantity__value quickview__value--quantity decrease"
                                                                    aria-label="quantity value"
                                                                    value="Decrease Value">-</button>
                                                                <label>
                                                                    <input type="number"
                                                                        class="quantity__number quickview__value--number"
                                                                        value="{{ $detail_order_log->quantity }}"
                                                                        min="1" data-counter />
                                                                </label>
                                                                <button type="button"
                                                                    class="quantity__value quickview__value--quantity increase"
                                                                    aria-label="quantity value"
                                                                    value="Increase Value">+</button>
                                                            </div>
                                                        </td>
                                                        <td class="cart__table--body__list">
                                                            <span class="cart__price end">£130.00</span>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox-rect">
                                                                <input type="checkbox"
                                                                    id="checkbox-one-{{ $detail_order_log->id }}"
                                                                    class="checkbox-one" name="check">
                                                                <label for="checkbox-one-{{ $detail_order_log->id }}"
                                                                    class=""></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="continue__shopping d-flex justify-content-between">
                        <a class="continue__shopping--link" href="javascript:void(0)">Trang thanh toán</a>
                        <button class="continue__shopping--clear" type="submit">Xóa giỏ hàng</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- cart section end -->

    <!-- Start product section -->
    <section class="product__section product__section--style3 section--padding pt-0">
        <div class="container-fluid">
            <div class="section__heading3 mb-40">
                <h2 class="section__heading3--maintitle">{{ $title_product }} mới</h2>
            </div>
            <div
                class="product__section--inner product3__section--inner__padding product__section--style3__inner product__column6--activation swiper">
                <div class="swiper-wrapper">
                    @foreach ($dishes as $dish)
                        <div class="swiper-slide">
                            <div class="product__items product__items2">
                                <div class="product__items--thumbnail">
                                    <a class="product__items--link"
                                        href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                        <img class="product__items--img product__primary--img"
                                            src="{{ !empty($dish->image[0]) ? asset('storage/' . $dish->image[0]) : asset('img/background_default.jpg') }}"
                                            alt="product-img">
                                        @if (!empty($dish->image[1]))
                                            <img class="product__items--img product__secondary--img"
                                                src="{{ asset('storage/' . $dish->image[1]) }}" alt="product-img">
                                        @endif
                                    </a>
                                    @php
                                        $nowDate = Carbon\Carbon::now();
                                        $promotion = \App\Models\Promotion::query()
                                            ->where('type', 3)
                                            ->where('restaurant_id', $dish->restaurant_id)
                                            ->whereDate('started_at', '<=', $nowDate)
                                            ->whereDate('ended_at', '>=', $nowDate)
                                            ->first();
                                    @endphp
                                    @if (!empty($promotion))
                                        <div class="product__badge">
                                            <span class="product__badge--items sale">Sale</span>
                                        </div>
                                    @endif
                                    <ul class="product__items--action">
                                        <li class="product__items--action__list">
                                            <a class="product__items--action__btn" href="wishlist.html">
                                                <svg class="product__items--action__btn--svg"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="32" />
                                                </svg>
                                                <span class="visually-hidden">Wishlist</span>
                                            </a>
                                        </li>
                                        <li class="product__items--action__list">
                                            <a class="product__items--action__btn" data-open="modal1"
                                                href="javascript:void(0)">
                                                <svg class="product__items--action__btn--svg"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                        fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                        stroke-width="32" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-miterlimit="10" stroke-width="32"
                                                        d="M338.29 338.29L448 448" />
                                                </svg>
                                                <span class="visually-hidden">Quick View</span>
                                            </a>
                                        </li>
                                        <li class="product__items--action__list">
                                            <a class="product__items--action__btn" href="compare.html">
                                                <svg class="product__items--action__btn--svg"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="32"
                                                        d="M400 304l48 48-48 48M400 112l48 48-48 48M64 352h85.19a80 80 0 0066.56-35.62L256 256" />
                                                    <path
                                                        d="M64 160h85.19a80 80 0 0166.56 35.62l80.5 120.76A80 80 0 00362.81 352H416M416 160h-53.19a80 80 0 00-66.56 35.62L288 208"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="32" />
                                                </svg>
                                                <span class="visually-hidden">Compare</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__items--content product__items2--content text-center">
                                    <a class="add__to--cart__btn"
                                        href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">Chi
                                        tiết</a>
                                    <h3 class="product__items--content__title h4"><a
                                            href="javascript:void(0)">{{ $dish->name }}</a></h3>
                                    <div class="product__items--price">
                                        <span class="current__price">{{ number_format($dish->price) }} VND</span>
                                    </div>
                                    <div class="product__items--rating d-flex justify-content-center align-items-center">
                                        <ul class="d-flex">
                                            <li class="product__items--rating__list">
                                                <span class="product__items--rating__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732"
                                                        viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy"
                                                            d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                            transform="translate(0 -0.018)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="product__items--rating__list">
                                                <span class="product__items--rating__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732"
                                                        viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy"
                                                            d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                            transform="translate(0 -0.018)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="product__items--rating__list">
                                                <span class="product__items--rating__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732"
                                                        viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy"
                                                            d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                            transform="translate(0 -0.018)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="product__items--rating__list">
                                                <span class="product__items--rating__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732"
                                                        viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy"
                                                            d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                            transform="translate(0 -0.018)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="product__items--rating__list">
                                                <span class="product__items--rating__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732"
                                                        viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy"
                                                            d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                            transform="translate(0 -0.018)" fill="#c7c5c2" />
                                                    </svg>
                                                </span>
                                            </li>
                                        </ul>
                                        <span class="product__items--rating__count--number">(24)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next"></div>
                <div class="swiper__nav--btn swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- End product section -->

    <!-- Start brand logo section -->
    <div class="brand__logo--section section--padding pt-0">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="brand__logo--section__inner d-flex justify-content-between align-items-center">
                        <div class="brand__logo--items">
                            <img class="brand__logo--items__thumbnail--img display-block"
                                src="{{ asset('template_web_user/assets/img/logo/brand-logo1.png') }}" alt="brand img">
                        </div>
                        <div class="brand__logo--items">
                            <img class="brand__logo--items__thumbnail--img display-block"
                                src="{{ asset('template_web_user/assets/img/logo/brand-logo2.png') }}" alt="brand img">
                        </div>
                        <div class="brand__logo--items">
                            <img class="brand__logo--items__thumbnail--img display-block"
                                src="{{ asset('template_web_user/assets/img/logo/brand-logo3.png') }}" alt="brand img">
                        </div>
                        <div class="brand__logo--items">
                            <img class="brand__logo--items__thumbnail--img display-block"
                                src="{{ asset('template_web_user/assets/img/logo/brand-logo4.png') }}" alt="brand img">
                        </div>
                        <div class="brand__logo--items">
                            <img class="brand__logo--items__thumbnail--img display-block"
                                src="{{ asset('template_web_user/assets/img/logo/brand-logo5.png') }}" alt="brand img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End brand logo section -->
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('user.partials.script.toastr')
    @endif
    @include('user.cart.script')
@stop
