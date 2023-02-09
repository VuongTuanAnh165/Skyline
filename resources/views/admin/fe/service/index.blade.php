@extends('admin.fe.layouts.master')
@section('title', $service->name )
@section('addcss')
    <style>
        .service-item {
            margin-top: 30px;
        }
        .service-item:nth-child(1), .service-item:nth-child(2), .service-item:nth-child(3) {
            margin-top: 0px;
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
            <div class="g-custom-x" style="display: flex;
                justify-content: center;">
                @foreach($service_types as $service_type)
                    <div class="service-item">
                        <div class="pricing-table pricing-s1">
                            <div class="top">
                                <h3>{{$service_type->name}}</h3>
                                <p class="plan-tagline id">{{$service_type->description}}</p>
                            </div>
                            <div class="mid" style="display: flex;
                                padding: 0;
                                align-items: center;
                                justify-content: center;
                                height: 71px;">
                                @php
                                    $service_charges = \App\Models\ServiceCharge::where('service_type_id', $service_type->id)->orderBy('month')->get();
                                @endphp
                                <select class="form-control" style="background-color: #ebf7fd;
                                    padding: 10px;
                                    font-size: 16px;
                                    border-radius: 30px;
                                    border: none;
                                    margin: auto;
                                    width: 80%;
                                    padding: 10px 25px;">
                                    @foreach($service_charges as $service_charge)
                                        <option value="{{$service_charge->id}}">{{number_format($service_charge->price) . ' VND / ' . $service_charge->month . ' tháng'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="bottom" style="padding-top: 20px;">
                                <div class="content" style="width: 80%; margin:auto">
                                    {!!$service->content!!}
                                </div>
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