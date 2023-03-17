@extends('user.layouts.master')
@section('title', __('messages.admin.home') )
@section('addcss')
    <style>
        .banner__items--thumbnail:hover {
            color: #000000;
        }
        .banner__items--thumbnail__img {
            width: 100%;
            opacity: 0.5;
        }
    </style>
@stop
@section('content')
<!-- Start slider section -->
<section class="hero__slider--section">
    <div class="hero__slider--inner hero__slider--activation swiper">
        <div class="hero__slider--wrapper swiper-wrapper">
            @foreach($images as $image)
                <div class="swiper-slide ">
                    <div class="hero__slider--items slider__2--bg">
                        <div class="container">
                            <div class="hero__slider--items__inner two">
                                <div class="row  align-items-center">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <div class="slider__content2">
                                            <span class="slider__content2--subtitle">Sản phẩm chính hãng 100%</span>
                                            <h2 class="slider__content2--maintitle h1">{{$image->type == 5 ? 'Fashion' : 'Tasty & Healthy'}} <br>
                                                {{$image->type == 5 ? 'Sky Line' : 'Sky Line Food'}}</h2>
                                            <a class="btn slider__btn" href="shop.html">Mua ngay</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="hero__slider--layer text-right">
                                            <img class="slider__layer--img" src="{{asset('storage/'.$image->image)}}" alt="slider-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider__pagination swiper-pagination"></div>
    </div>
</section>
<!-- End slider section -->

<!-- Start banner section -->
<section class="banner__section section--padding">
    <div class="container">
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 mb--n30">
            @foreach($promotions as $promotion)
                <div class="col mb-30">
                    <div class="banner__items position__relative">
                        <a class="banner__items--thumbnail display-block" href=""><img class="banner__items--thumbnail__img display-block" src="{{ asset('storage/'.$promotion->image) }}" alt="banner-img">
                            <div class="banner__two--content">
                                <p class="banner__two--content__desc">Giảm tới {{ number_format($promotion->value) }} VND</p>
                                <h2 class="banner__two--content__title">{{ $promotion->name }}</h2>
                                <span class="banner__two--content__btn">Shop Now
                                    <svg class="banner__two--content__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="10.383" height="7.546" viewBox="0 0 10.383 7.546">
                                        <path data-name="Path 77287" d="M10.241,45.329l-3.09-3.263a.465.465,0,0,0-.683,0,.53.53,0,0,0,0,.721l2.266,2.393H.483a.511.511,0,0,0,0,1.02H8.734L6.469,48.592a.53.53,0,0,0,0,.721.465.465,0,0,0,.683,0l3.09-3.263A.53.53,0,0,0,10.241,45.329Z" transform="translate(0 -41.916)" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End banner section -->

<!-- Start categories product section -->
<section class="product__section product__categories--section section--padding pt-0">
    <div class="container">
        <div class="section__heading mb-40">
            <h2 class="section__heading--maintitle">Danh mục</h2>
        </div>
        <div class="product__section--inner categories2__swiper--activation swiper">
            <div class="swiper-wrapper">
                @foreach($categoryHomes as $key => $categoryHome)
                <div class="swiper-slide">
                    <div class="{{ $key == 0 ? 'categories2__product--items' : 'product__items' }} text-center">
                        <div class="categories2__product--thumbnail">
                            <a class="categories2__product--link display-block" href="#" onclick="event.preventDefault(); document.getElementById('product-redirect-2-{{$categoryHome->id}}').submit();"><img class="categories2__product--img display-block" src="{{ asset('storage/'.$categoryHome->image) }}" alt="categories-img"></a>
                        </div>
                        <div class="product__categories--content2">
                            <h3 class="product__categories--content2__maintitle"><a href="#" onclick="event.preventDefault(); document.getElementById('product-redirect-2-{{$categoryHome->id}}').submit();">{{ $categoryHome->name }}</a></h3>
                        </div>
                        <form id="product-redirect-2-{{$categoryHome->id}}" action="{{ $url_product }}" method="GET" style="display: none;">
                            <input type="hidden" name="categoryHome" value="{{$categoryHome->id}}">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper__nav--btn swiper-button-next"></div>
            <div class="swiper__nav--btn swiper-button-prev"></div>
        </div>
    </div>
</section>
<!-- End categories product section -->

<!-- Start product section -->
<section class="product__section section--padding pt-0">
    <div class="container">
        <div class="product__section--topbar d-flex justify-content-between align-items-center mb-50">
            <div class="section__heading">
                <h2 class="section__heading--maintitle">Gợi ý hôm nay</h2>
            </div>
        </div>
        <div class="tab_content">
            <div id="product_all" class="tab_pane active show">
                <div class="product__section--inner">
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n28">
                        @foreach($dishes as $dish)
                            <div class="col mb-28">
                                <div class="product__items product__items2">
                                    <div class="product__items--thumbnail">
                                        <a class="product__items--link" href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                            <img class="product__items--img product__primary--img" src="{{asset('storage/'.$dish->image)}}" alt="product-img">
                                            @php
                                                $item = \App\Models\MenuItem::query()
                                                    ->leftJoin('menus', 'menus.id', 'menu_items.menu_id')
                                                    ->leftJoin('menu_dishes', 'menu_dishes.menu_id', 'menus.id')
                                                    ->where('menu_dishes.dish_id', $dish->id)
                                                    ->whereNotNull('menu_items.image')
                                                    ->first();
                                            @endphp
                                            @if(!empty($item))
                                                <img class="product__items--img product__secondary--img" src="{{asset('storage/'.$item->image)}}" alt="product-img">
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
                                        @if(!empty($promotion))
                                        <div class="product__badge">
                                            <span class="product__badge--items sale">Sale</span>
                                        </div>
                                        @endif
                                        <ul class="product__items--action">
                                            <li class="product__items--action__list">
                                                <a class="product__items--action__btn" href="wishlist.html">
                                                    <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                    </svg>
                                                    <span class="visually-hidden">Wishlist</span>
                                                </a>
                                            </li>
                                            <li class="product__items--action__list">
                                                <a class="product__items--action__btn" data-open="modal1" href="javascript:void(0)">
                                                    <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                                    </svg>
                                                    <span class="visually-hidden">Quick View</span>
                                                </a>
                                            </li>
                                            <li class="product__items--action__list">
                                                <a class="product__items--action__btn" href="compare.html">
                                                    <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 304l48 48-48 48M400 112l48 48-48 48M64 352h85.19a80 80 0 0066.56-35.62L256 256" />
                                                        <path d="M64 160h85.19a80 80 0 0166.56 35.62l80.5 120.76A80 80 0 00362.81 352H416M416 160h-53.19a80 80 0 00-66.56 35.62L288 208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                    </svg>
                                                    <span class="visually-hidden">Compare</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__items--content product__items2--content text-center">
                                        <a class="add__to--cart__btn" href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">Chi tiết</a>
                                        <h3 class="product__items--content__title h4"><a href="javascript:void(0)">{{ $dish->name }}</a></h3>
                                        <div class="product__items--price">
                                            <span class="current__price">{{ number_format($dish->price) }} VND</span>
                                        </div>
                                        <div class="product__items--rating d-flex justify-content-center align-items-center">
                                            <ul class="d-flex">
                                                <li class="product__items--rating__list">
                                                    <span class="product__items--rating__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732" viewBox="0 0 10.105 9.732">
                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li class="product__items--rating__list">
                                                    <span class="product__items--rating__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732" viewBox="0 0 10.105 9.732">
                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li class="product__items--rating__list">
                                                    <span class="product__items--rating__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732" viewBox="0 0 10.105 9.732">
                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li class="product__items--rating__list">
                                                    <span class="product__items--rating__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732" viewBox="0 0 10.105 9.732">
                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li class="product__items--rating__list">
                                                    <span class="product__items--rating__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.105" height="9.732" viewBox="0 0 10.105 9.732">
                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#c7c5c2" />
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
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ $url_allProduct }}" class="btn-read-more">Xem thêm</a>
        </div>
    </div>
</section>
<!-- End product section -->
@stop
@section('addjs')
@if (session('success') || session('error'))
    @include('user.partials.script.toastr')
@endif
@stop