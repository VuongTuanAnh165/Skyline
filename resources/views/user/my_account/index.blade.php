@extends('user.layouts.master')
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Tài khoản của bạn</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{ $url_home }}">Trang chủ</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Tài khoản của
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
                            <li class="account__menu--list active"><a href="my-account.html">Đơn hàng</a></li>
                            <li class="account__menu--list"><a href="my-account-2.html">Thông tin tài khoản</a></li>
                        </ul>
                    </div>
                    @yield('content_my_account')
                </div>
            </div>
        </section>
    </main>
@stop
