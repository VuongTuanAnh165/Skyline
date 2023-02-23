@extends('admin.fe.layouts.master')
@section('title', $service_type->service_name )
@section('addcss')
<style>
    .not-active-background {
        background-color: rgb(219, 237, 247);
        background-size: 100%;
        background-repeat: no-repeat;
    }

    .img-fluid {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

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
                        <h1>{{$service_type->service_name}}</h1>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <p class="lead">{{$service_type->service_group_description}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section id="form-hire" class="mt-100 no-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header p-0">
                            <div class="row m-0">
                                <a href="javascript:void(0)" class="col-6 py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Đăng nhập</h6>
                                </a>
                                <a href="javascript:void(0)" class="col-6 py-3 not-active-background">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Đăng ký</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-header">
                                    <h5 class="modal-title">Đăng nhập tài khoản trước khi đăng ký dịch vụ</h5>
                                </div>
                                <div class="modal-body osahan-my-cart">
                                    <div class="form-group pb-3">
                                        <label for="email" class="form-label font-weight-bold small">Email</label>
                                        <div class="input-group">
                                            <input placeholder="Email" type="email" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group border-top pt-3">
                                        <label for="password" class="form-label font-weight-bold small">Password</label>
                                        <div class="input-group">
                                            <input placeholder="Password" type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start osahan-my-cart-footer">
                                    <button id="" class="btn btn-primary btn-block">Đăng nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                            <div class="row m-0">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Thông tin dịch vụ</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body border-bottom">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{asset('storage/'.$service_type->service_image)}}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2">
                                            <h5 class="mb-0" style="margin-left: 16px;">Dịch vụ: <span class="text-primary">{{$service_type->service_name}}</span></h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Nhóm dịch vụ: <span class="text-primary">{{$service_type->service_group_name}}</span></h5>
                                    <h5 class="modal-title">Loại dịch vụ: <span class="text-primary">{{$service_type->name}}</span></h5>
                                </div>
                                <div class="modal-body osahan-my-cart">
                                    <div class="form-group">
                                        <label class="form-label small font-weight-bold">Phí dịch vụ</label><br>
                                        <select class="custom-select form-control service_charge_id text-primary">
                                            @foreach($service_charges as $service_charge)
                                                <option value="{{$service_charge->id}}">{{ number_format($service_charge->price) }} VND / {{ $service_charge->month }} tháng</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start osahan-my-cart-footer">
                                    <button id="" class="btn btn-primary btn-block">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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