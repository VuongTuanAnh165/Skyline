@extends('user.restaurant.master')
@section('title', $restaurant->name )
@section('addcss')

@stop
@php
$request = request();
$name_route = Route::currentRouteName();
@endphp
@section('content_restaurant')
<!-- Start offcanvas filter sidebar -->
<div class="offcanvas__filter--sidebar widget__area">
    <button type="button" class="offcanvas__filter--close" data-offcanvas>
        <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
        </svg> <span class="offcanvas__filter--close__text">Đóng</span>
    </button>
    <div class="offcanvas__filter--sidebar__inner">
        <div class="single__widget widget__bg">
            <h2 class="widget__title h3">Tìm kiếm theo danh mục</h2>
            <ul class="widget__categories--menu">
                @foreach($categories as $category)
                <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="{{ asset('storage/'.$category->image) }}" alt="categories-img">
                        <span class="widget__categories--menu__text">{{ $category->name }}</span>
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="single__widget price__filter widget__bg">
            <h2 class="widget__title h3">Lọc theo giá</h2>
            <div class="price__filter--form">
                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-GTE">From</label>
                        <div class="price__filter--input">
                            <span class="price__filter--currency">đ</span>
                            <input class="price__filter--input__field price-min border-0" value="{{ $request->has('priceMin') ? $request->priceMin : '' }}" name="filter.v.price.gte" id="Filter-Price-GTE" type="number" placeholder="0" min="0" max="250.00">
                        </div>
                    </div>
                    <div class="price__divider">
                        <span>-</span>
                    </div>
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-LTE">To</label>
                        <div class="price__filter--input">
                            <span class="price__filter--currency">đ</span>
                            <input class="price__filter--input__field price-max border-0" value="{{ $request->has('priceMax') ? $request->priceMax : '' }}" name="filter.v.price.lte" id="Filter-Price-LTE" type="number" min="0" placeholder="250.00" max="250.00">
                        </div>
                    </div>
                </div>
                <button class="btn price__filter--btn btn-search-price" type="submit">Lọc</button>
            </div>
        </div>
    </div>
</div>
<!-- End offcanvas filter sidebar -->

<!-- Start shop section -->
<section class="shop__section section--padding">
    <div class="container-fluid">
        <div class="section__heading text-center mb-40">
            <h2 class="section__heading--maintitle">{{ $title }}</h2>
        </div>
        <div class="shop__header bg__gray--color d-flex align-items-center justify-content-between mb-30">
            <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                    <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                    <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                    <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                </svg>
                <span class="widget__filter--btn__text">Lọc</span>
            </button>
            <div class="product__view--mode d-flex align-items-center">
                <div class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
                    <label class="product__view--label">Sắp xếp :</label>
                    <div class="select shop__header--select">
                        <select class="product__view--select">
                            <option {{ $request->has('sort') && $request->sort == 1 ? 'selected' : '' }} value="1">Mới nhất</option>
                            <option {{ $request->has('sort') && $request->sort == 2 ? 'selected' : '' }} value="2">Giá tăng dần</option>
                            <option {{ $request->has('sort') && $request->sort == 3 ? 'selected' : '' }} value="3">Giá giảm dần</option>
                        </select>
                    </div>
                </div>
                <div class="product__view--mode__list product__view--search d-xl-block ">
                    <form id="product-redirect" class="product__view--search__form" action="{{ route($name_route, ['id'=>$restaurant->id]) }}">
                        <label>
                            <input class="product__view--search__input border-0" name="keyword" value="{{ $request->has('keyword') ? $request->keyword : '' }}" placeholder="Tìm kiếm" type="text">
                            <input type="hidden" id="input-category" name="category" value="{{ $request->has('category') ? $request->category : '' }}">
                            <input type="hidden" id="price-min" name="priceMin" value="{{ $request->has('priceMin') ? $request->priceMin : '' }}">
                            <input type="hidden" id="price-max" name="priceMax" value="{{ $request->has('priceMax') ? $request->priceMax : '' }}">
                            <input type="hidden" id="sort" name="sort" value="{{ $request->has('sort') ? $request->sort : 1 }}">
                        </label>
                        <button class="product__view--search__btn" aria-label="search btn" type="submit">
                            <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <a href="{{ route($name_route, ['id'=>$restaurant->id]) }}" class="btn price__filter--btn product__showing--count">Làm mới</a>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="shop__sidebar--widget widget__area d-none d-lg-block bg__gray--color">
                    <div class="single__widget widget__bg">
                        <h2 class="widget__title h3">Tìm kiếm theo danh mục</h2>
                        <ul class="widget__categories--menu">
                            @foreach($categories as $category)
                            <li class="widget__categories--menu__list" data-category="{{ $category->id }}">
                                <label class="widget__categories--menu__label {{ ($request->has('category') && $request->category!=null && $request->category == $category->id) ? 'active' : '' }} d-flex align-items-center">
                                    <img class="widget__categories--menu__img" src="{{ asset('storage/'.$category->image) }}" alt="categories-img">
                                    <span class="widget__categories--menu__text">{{ $category->name }}</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single__widget price__filter widget__bg">
                        <h2 class="widget__title h3">Lọc theo giá</h2>
                        <div class="price__filter--form">
                            <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                                <div class="price__filter--group">
                                    <label class="price__filter--label" for="Filter-Price-GTE2">From</label>
                                    <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                        <span class="price__filter--currency">đ</span>
                                        <input class="price__filter--input__field price-min border-0" value="{{ $request->has('priceMin') ? $request->priceMin : '' }}" id="Filter-Price-GTE2" type="number" placeholder="0" min="0" max="250.00">
                                    </div>
                                </div>
                                <div class="price__divider">
                                    <span>-</span>
                                </div>
                                <div class="price__filter--group">
                                    <label class="price__filter--label" for="Filter-Price-LTE2">To</label>
                                    <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                        <span class="price__filter--currency">đ</span>
                                        <input class="price__filter--input__field price-max border-0" value="{{ $request->has('priceMax') ? $request->priceMax : '' }}" id="Filter-Price-LTE2" type="number" min="0" placeholder="250.00" max="250.00">
                                    </div>
                                </div>
                            </div>
                            <button class="btn price__filter--btn btn-search-price">Lọc</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="shop__product--wrapper">
                    <div class="tab_content">
                        <div id="product_grid" class="tab_pane active show">
                            <div class="product__section--inner product__section--style3__inner">
                                <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 row-cols-2 mb--n30">
                                    @foreach($dishes as $dish)
                                    @if($request->has('category') && $request->category!=null)
                                    @if($request->category == $dish->category_id)
                                    <div class="col mb-30">
                                        <div class="product__items product__items2">
                                            <div class="product__items--thumbnail">
                                                <a class="product__items--link" href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                                    <img class="product__items--img product__primary--img" src="{{asset('storage/'.$dish->image)}}" alt="product-img">
                                                    @php
                                                    $item = \App\Models\MenuItem::query()
                                                    ->leftJoin('menus', 'menus.id', 'menu_items.menu_id')
                                                    ->where('menus.dish_id', $dish->id)
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
                                                ->whereDate('started_at', '<=', $nowDate) ->whereDate('ended_at', '>=', $nowDate)
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
                                                <a class="add__to--cart__btn" href="cart.html">+ Thêm giỏ hàng</a>
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
                                    @endif
                                    @else
                                    <div class="col mb-30">
                                        <div class="product__items product__items2">
                                            <div class="product__items--thumbnail">
                                                <a class="product__items--link" href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                                    <img class="product__items--img product__primary--img" src="{{asset('storage/'.$dish->image)}}" alt="product-img">
                                                    @php
                                                    $item = \App\Models\MenuItem::query()
                                                    ->leftJoin('menus', 'menus.id', 'menu_items.menu_id')
                                                    ->where('menus.dish_id', $dish->id)
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
                                                ->whereDate('started_at', '<=', $nowDate) ->whereDate('ended_at', '>=', $nowDate)
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
                                                <a class="add__to--cart__btn" href="cart.html">+ Thêm giỏ hàng</a>
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
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $dishes->links('user.layouts.pagination')}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End shop section -->

<!-- Start blog section -->
<section class="blog__section section--padding pt-0">
    <div class="container blog__section--container">
        <div class="section__heading text-center mb-40">
            <h2 class="section__heading--maintitle">Tin tức</h2>
        </div>
        <div class="blog__section--inner blog__swiper--activation swiper">
            <div class="swiper-wrapper">
                @foreach($posts as $post)
                <div class="swiper-slide">
                    <div class="blog__items">
                        <div class="blog__items--thumbnail">
                            <a class="blog__items--link" href="{{ route($url_post, ['id' => $post->id, 'name_link' => $post->name_link]) }}"><img class="blog__items--img" src="{{ asset('storage/'.$post->image) }}" alt="blog-img"></a>
                        </div>
                        <div class="blog__items--content">
                            <div class="blog__items--meta">
                                <ul class="d-flex">
                                    <li class="blog__items--meta__list">
                                        <svg class="blog__items--meta__icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                            <path d="M74.705,129.154a6.088,6.088,0,0,0,1.085-5.056,6.167,6.167,0,0,0-2.539-3.839,6.608,6.608,0,0,0-4.958-1.207,6.475,6.475,0,0,0-4.356,2.53,6.056,6.056,0,0,0-1.174,5.154,14.881,14.881,0,0,1,.442,2.339,5.759,5.759,0,0,1-.494,2.849c-.065.136-.139.266-.213.4.029.012.043.022.055.02a6.859,6.859,0,0,0,3.154-1.268.223.223,0,0,1,.281-.043,6.72,6.72,0,0,0,4.658.7,6.475,6.475,0,0,0,4.058-2.585Zm2.717,4.572a2.756,2.756,0,0,1-.261-.425,4.205,4.205,0,0,1-.1-2.971,4.6,4.6,0,0,0-.139-3.087c-.113-.278-.267-.534-.427-.851-.031.134-.046.191-.057.25a6.593,6.593,0,0,1-.849,2.323,7.164,7.164,0,0,1-4.994,3.5c-.367.071-.741.095-1.119.142a.19.19,0,0,0,.036.055c.094.071.185.144.285.2a4.856,4.856,0,0,0,4.87.278.261.261,0,0,1,.23,0,4.912,4.912,0,0,0,1.725.752,2.973,2.973,0,0,0,.72.081C77.531,133.97,77.541,133.895,77.423,133.726Z" transform="translate(-62.5 -118.975)" fill="currentColor" />
                                        </svg>
                                        <span class="blog__items--meta__text">19 Comments</span>
                                    </li>
                                    <li class="blog__items--meta__list">
                                        <svg class="blog__items--meta__icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                            <path d="M75.809,63.836c0-.221,0-.429,0-.639a.915.915,0,0,0-.656-.869.959.959,0,0,0-1.057.321.97.97,0,0,0-.2.619v.559a.163.163,0,0,1-.164.161H72.716a.162.162,0,0,1-.164-.161c0-.192,0-.377,0-.564a.959.959,0,0,0-1.918-.06c-.005.206,0,.413,0,.62a.163.163,0,0,1-.164.161H69.428a.162.162,0,0,1-.164-.161,5.7,5.7,0,0,0-.009-.768.849.849,0,0,0-.627-.725.93.93,0,0,0-.942.185.952.952,0,0,0-.329.79c0,.175,0,.35,0,.533A.163.163,0,0,1,67.2,64H64.363a.162.162,0,0,0-.164.161V77.113a.163.163,0,0,0,.164.161H79.036a.162.162,0,0,0,.164-.161V64.158A.163.163,0,0,0,79.036,64H75.972A.161.161,0,0,1,75.809,63.836ZM68.7,76.636h-3.68a.162.162,0,0,1-.164-.161V73.913a.163.163,0,0,1,.164-.161H68.7a.162.162,0,0,1,.164.161v2.561A.162.162,0,0,1,68.7,76.636Zm0-3.543H65.018a.162.162,0,0,1-.164-.161V70.224a.163.163,0,0,1,.164-.161H68.7a.162.162,0,0,1,.164.161v2.708A.163.163,0,0,1,68.7,73.093Zm0-3.685H65.018a.162.162,0,0,1-.164-.161v-2.6a.163.163,0,0,1,.164-.161H68.7a.162.162,0,0,1,.164.161v2.6A.162.162,0,0,1,68.7,69.408Zm4.9,7.23H69.71a.162.162,0,0,1-.164-.161V73.921a.163.163,0,0,1,.164-.161H73.6a.162.162,0,0,1,.164.161v2.557A.16.16,0,0,1,73.6,76.638Zm.172-3.632c0,.05-.077.089-.169.089h-3.9a.162.162,0,0,1-.164-.161v-2.71c0-.089.043-.163.093-.166l.093-.005c1.282,0,2.563,0,3.844,0,.155,0,.208.034.207.2-.007.89,0,1.783-.005,2.672A.747.747,0,0,1,73.776,73.006Zm.005-3.694c0,.05-.074.091-.164.091H69.707a.162.162,0,0,1-.164-.161V66.636c0-.089.043-.161.1-.161h.1c1.282,0,2.563,0,3.844,0,.155,0,.207.036.2.2-.007.852,0,1.7,0,2.552v.091Zm.823.756h3.772a.162.162,0,0,1,.164.161v2.706a.163.163,0,0,1-.164.161H74.6a.162.162,0,0,1-.164-.161V70.227A.162.162,0,0,1,74.6,70.068Zm3.773,6.568H74.6a.162.162,0,0,1-.164-.161V73.918a.163.163,0,0,1,.164-.161h3.773a.162.162,0,0,1,.164.161v2.557A.158.158,0,0,1,78.377,76.636Zm0-7.233H74.6a.162.162,0,0,1-.164-.161V66.648a.163.163,0,0,1,.164-.161h3.773a.162.162,0,0,1,.164.161v2.593A.159.159,0,0,1,78.377,69.4Z" transform="translate(-64.2 -62.274)" fill="currentColor" />
                                        </svg>
                                        <span class="blog__items--meta__text">{{ $post->updated_at }}</span>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="blog__items--title"><a href="{{ route($url_post, ['id' => $post->id, 'name_link' => $post->name_link]) }}">{{ $post->name }}</a></h3>
                            <p class="blog__items--desc">I{{ $post->description }}</p>
                            <a class="blog__items--readmore" href="{{ route($url_post, ['id' => $post->id, 'name_link' => $post->name_link]) }}">Xem thêm <svg class="blog__items--readmore__icon" xmlns="http://www.w3.org/2000/svg" width="6.2" height="6.2" viewBox="0 0 6.2 6.2">
                                    <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor" />
                                </svg>
                            </a>
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
<!-- End blog section -->
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('user.partials.script.toastr')
@endif
@include('user.restaurant.script')
@stop