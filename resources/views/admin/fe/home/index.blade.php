@extends('admin.fe.layouts.master')
@section('title', __('messages.admin.home') )
@section('addcss')
<style>
    .item-service-type {
        box-shadow: rgb(17 17 26 / 10%) 0px 4px 16px, rgb(17 17 26 / 10%) 0px 8px 24px, rgb(17 17 26 / 10%) 0px 16px 56px;
    }

    .list-service-type {
        display: flex;
        justify-content: space-evenly;
        border: none;
    }
</style>
@stop
@section('content')
@php
$service_home = !empty($service_show_home) ? $service_show_home : $service_first;
$service_group = \App\Models\ServiceGroup::where('id', $service_home->service_group_id)->first();
@endphp
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <section id="section-hero" class="section-hero-home" aria-label="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>{{ $service_home->name }}</h1>
                    <p class="lead">{{ $service_group->description }}</p>
                    <form action='' class="row" data-wow-delay="1.25s" id='form_sb' method="post" name="form_sb">
                        <div class="col">
                            <div class="spacer-10"></div>
                            <input class="form-control" id='email_service' name='email_service' placeholder="Nhập email" type='email'>
                            <a href="javascript:;" id="btn-submit" class="btn-check-email"><i class="arrow_right btn-check-email"></i></a href="jajavascript:;">
                            <div class="clearfix"></div>
                            <div class="spacer-10"></div>
                            <p class="d-small response-check-email">Đăng ký email acount của bạn ngay hôm nay trước khi ai đó lấy nó.</p>
                            <div class="domain-ext pos-left">
                                {!! $service_home->content !!}
                            </div>
                        </div>
                    </form>
                    <div class="spacer-double"></div>
                </div>
                <div class="col-md-6 xs-hide">
                    <img src="{{asset('template_web_service/images/misc/server-2.png')}}" class="lazy img-fluid anim-up-down" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="no-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInUp">
                    <img class="img-fluid anim-up-down" src="{{ asset('template_web_service/images/misc/server.png') }}" alt="">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="p-sm-30 pb-sm-0 mb-sm-0">
                        <h2>Chức năng mới mang lại <span class="color-gradient">sức mạnh</span> tối đa cho trang web của bạn.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        <div class="row">
                            <div class="col-md-5">
                                <ul class="ul-style-2">
                                    <li>
                                        <h4>Kích hoạt tức thì</h4>
                                    </li>
                                    <li>
                                        <h4>Thời gian hoạt động 99.9% </h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="ul-style-2">
                                    <li>
                                        <h4>Tài khoản đáng tin cậy</h4>
                                    </li>
                                    <li>
                                        <h4>Hỗ trợ 24 / 7</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="spacer-half"></div>
                        <a class="btn-main" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="no-top">
        <div class="container">
            <div class="row g-custom-x force-text-center">
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count wow fadeInUp">
                        <h3 class="timer" data-to="15425" data-speed="3000">0</h3>
                        Website Powered
                        <p class="d-small">Lorem ipsum adipisicing officia in adipisicing do velit sit tempor ea consectetur.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count wow fadeInUp">
                        <h3 class="timer" data-to="8745" data-speed="3000">0</h3>
                        Clients Supported
                        <p class="d-small">Lorem ipsum adipisicing officia in adipisicing do velit sit tempor ea consectetur.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count wow fadeInUp">
                        <h3 class="timer" data-to="235" data-speed="3000">0</h3>
                        Awards Winning
                        <p class="d-small">Lorem ipsum adipisicing officia in adipisicing do velit sit tempor ea consectetur.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-30">
                    <div class="de_count wow fadeInUp">
                        <h3 class="timer" data-to="15" data-speed="3000">0</h3>
                        Years Experience
                        <p class="d-small">Lorem ipsum adipisicing officia in adipisicing do velit sit tempor ea consectetur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-pricing" class="no-top section-pricing-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="text-center">
                        <h5 class="s2">{{$service_group->name}}</h5>
                        <h2>Chọn gói dịch vụ <span class="id-color">{{$service_home->name}}</span> hoàn hảo cho bạn</h2>
                        <div class="spacer-20"></div>
                    </div>
                </div>
            </div>
            <div class="list-service-type de_pricing-tables shadow-soft g-0">
                @php
                $service_types = \App\Models\ServiceType::where('service_id', $service_home->id)->get();
                @endphp
                @foreach($service_types as $service_type)
                <div class="item-service-type">
                    <div class="de_pricing-table type-2">
                        <div class="d-head">
                            <h3>{{$service_type->name}}</h3>
                            <p>{{$service_type->description}}</p>
                        </div>
                        <div class="d-price">
                            @php
                                $service_charge = \App\Models\ServiceCharge::where('service_type_id', $service_type->id)->orderBy('month')->first();
                            @endphp
                            <h4 class="opt-1">{{number_format($service_charge->price) . ' VND '}}<span> / {{$service_charge->month . ' tháng'}}</span></h4>
                        </div>
                        <div class="d-action">
                            <a href="{{ route('admin.fe.service.hire', ['id' => $service_type->id, 'name_link' => $service_home->name_link]) }}" class="btn-main w-100">Đăng ký</a>
                            <p>Sky Line, dịch vụ tốt nhất cho bạn</p>
                        </div>
                        <div class="d-group">
                            <h4>Nội dung</h4>
                            <div class="d-list">
                                {!! $service_home->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('admin.fe.layouts.near_service')
    <section id="section-locations" class="no-top no-bottom section-locations-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="col text-center">
                        <h5 class="s2">Phổ biến</h5>
                        <h2>Vị trí sử dụng</h2>
                        <p class="lead">Dịch vụ Skyline đã phát triện rộng rãi trên nhiều nước toán thế giới.</p>
                        <div class="spacer-20"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp">
                    <div class="p-sm-30 pb-sm-0 mb-sm-0">
                        <div class="de-map-hotspot">
                            <div class="de-spot wow fadeIn" style="top:39%; left:20%">
                                <span>United&nbsp;States</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:76%; left:87%">
                                <span>Australia</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:68%; left:80%">
                                <span>Indonesia</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:23%; left:18%">
                                <span>Canada</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:68%; left:33%">
                                <span>Brazil</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:19%; left:81%">
                                <span>Rusia</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:45%; left:75%">
                                <span>China</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:36%; left:48%">
                                <span>France</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:23%; left:51%">
                                <span>Sweden</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:78%; left:53%">
                                <span>South&nbsp;Africa</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <div class="de-spot wow fadeIn" style="top:56%; left:79%">
                                <span>Việt&nbsp;Nam</span>
                                <div class="de-circle-1"></div>
                                <div class="de-circle-2"></div>
                            </div>
                            <img src="{{asset('template_web_service/images/misc/map.png')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-double"></div>
        </div>
    </section>
    @include('admin.fe.layouts.near_footer')
    <section class="no-top" aria-label="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="owl-logo" class="logo-carousel owl-carousel owl-theme">
                        <img src="{{ asset('template_web_service/images/logo/1.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/2.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/3.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/4.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/5.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/6.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/7.png') }}" class="img-fluid" alt="">
                        <img src="{{ asset('template_web_service/images/logo/8.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@include('admin.fe.home.script')
@stop