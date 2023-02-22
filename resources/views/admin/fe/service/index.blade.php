@extends('admin.fe.layouts.master')
@section('title', $service->name )
@section('addcss')
<style>
    .service-item {
        margin-top: 30px;
        box-shadow: rgb(17 17 26 / 10%) 0px 4px 16px, rgb(17 17 26 / 10%) 0px 8px 24px, rgb(17 17 26 / 10%) 0px 16px 56px;
    }

    .service-item:nth-child(1),
    .service-item:nth-child(2),
    .service-item:nth-child(3) {
        margin-top: 0px;
    }

    .service-group {
        display: flex;
        justify-content: space-evenly;
    }
</style>
@stop
@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section id="subheader" class="jarallax">
        <img src="{{ asset('template_web_service/images/background/subheader.jpg') }}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{$service->name}}</h1>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <p class="lead">{{$service_group->description}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section id="section-hero" class="no-top mt-100" aria-label="section">
        <div class="container">
            <div class="spacer-10"></div>
            <div class="g-custom-x service-group">
                @foreach($service_types as $service_type)
                <div class="service-item">
                    <div class="pricing-table pricing-s1">
                        <div class="top">
                            <h3>{{$service_type->name}}</h3>
                            <p class="plan-tagline id">{{$service_type->description}}</p>
                        </div>
                        <div class="mid">
                            @php
                                $service_charge = \App\Models\ServiceCharge::where('service_type_id', $service_type->id)->orderBy('month')->first();
                            @endphp
                            <p class="price">
                                <span class="currency">VND</span>
                                <span class="m opt-1">{{number_format($service_charge->price)}}</span>
                                <span class="period">{{$service_charge->month}} tháng</span>
                            </p>
                        </div>
                        <div style="padding: 40px;" class="bottom">
                            {!!$service->content!!}
                        </div>
                        <div class="action">
                            <a href="" class="btn-main">Đăng ký</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <p class="d-small mt20">*Giá đã bao gồm cả thuế.</p>
            </div>
        </div>
    </section>
    @include('admin.fe.layouts.near_service')
    @include('admin.fe.layouts.near_footer')
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@include('admin.fe.home.script')
@stop