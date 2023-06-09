@extends('user.layouts.master')
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title mb-25">Tài khoản của bạn</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{ $url_home }}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="">Tài khoản của
                                        bạn</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container-my-account">
                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title h3 mb-20">{{ Auth::guard('user')->user()->name }}</h2>
                        <ul class="account__menu">
                            @php
                                $route_acount = Route::currentRouteName();
                                $arg_parent = ['user.food.my_account.order', 'user.my_account.order'];
                                $active_parent = '';
                                $display_parent = 'none';
                                if (in_array($route_acount, $arg_parent)) {
                                    $active_parent = 'active';
                                    $display_parent = '';
                                }
                            @endphp
                            <li class="account__menu--list {{ $active_parent }}"><a id="order"
                                    href="javascript:void(0)">Đơn hàng</a>
                            </li>
                            <ul class="account__menu account__menu_item menu_item_order"
                                style="display: {{ $display_parent }}">
                                @php
                                    $arg_son = ['user.food.my_account.order', 'user.my_account.order'];
                                    $active_son = '';
                                    if (in_array($route_acount, $arg_son)) {
                                        $active_son = 'active';
                                    }
                                @endphp
                                <li class="account__menu--list account__menu--list_item {{$active_son}}"><a id=""
                                        href="javascript:void(0)">Tất cả</a></li>
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Chờ xác nhận</a></li>
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Vận chuyển</a></li>
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Đang giao</a></li>
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Hoàn thành</a></li>
                            </ul>
                            <li class="account__menu--list"><a id="account" href="javascript:void(0)">Thông tin tài
                                    khoản</a></li>
                            <ul class="account__menu account__menu_item menu_item_account" style="display: none">
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Hồ sơ</a></li>
                                <li class="account__menu--list account__menu--list_item"><a id=""
                                        href="javascript:void(0)">Địa chỉ</a></li>
                            </ul>
                        </ul>
                    </div>
                    @yield('content_my_account')
                </div>
            </div>
        </section>
    </main>
@stop
