@extends('admin.fe.layouts.master')
@section('title', $service_type->service_name )
@section('addcss')
<style>
    .header-left {
        background-color: rgb(219, 237, 247);
        background-size: 100%;
        background-repeat: no-repeat;
    }

    .active-background {
        background-color: #ffffff;
    }

    .img-fluid {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .display-none {
        display: none;
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
                <div class="{{ !empty($ceo) ? 'col-md-6' : 'col-md-4' }} card-left">
                    @if(!empty($ceo))
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                            <div class="row m-0">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Thông tin cá nhân</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body border-bottom">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{ $ceo->avatar ? asset('storage/'.$ceo->avatar) : asset('img/avatar_default.png') }}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2" style="margin-left: 16px;">
                                            <h5 class="mb-0">Họ tên: <span class="text-primary">{{$ceo->name}}</span></h5>
                                            <span class="mb-0 small text-black-50">Email: <span class="text-primary">{{$ceo->email}}</span></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="modal-header">
                                    <h5 class="modal-title">CMND: <span class="text-primary">{{$ceo->cmnd}}</span></h5>
                                    <h5 class="modal-title">SĐT: <span class="text-primary">{{$ceo->phone}}</span></h5>
                                </div>
                                <div class="modal-body osahan-my-cart">
                                    <h5 class="modal-title">Địa chỉ: <span class="text-primary">{{$ceo->address}}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card shadow mb-4">
                        <div class="card-header p-0">
                            <div class="row m-0 header-left">
                                <a href="javascript:void(0)" class="col-6 py-3 active-background a-login">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Đăng nhập</h6>
                                </a>
                                <a href="javascript:void(0)" class="col-6 py-3 a-register">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Đăng ký</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page modal-login">
                                <form id="form_register" class="form-border form-customer" method="post" action="{{ route('admin.fe.post.login')}}">
                                    {{ csrf_field() }}
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
                                        <input type="hidden" value="{{ URL::current() }}" name="route">
                                    </div>
                                    <div class="modal-footer justify-content-start osahan-my-cart-footer">
                                        <button type="submit" id="" class="btn btn-primary btn-block">Đăng nhập</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-content-page modal-register display-none">
                                <form name="contactForm" id='contact_form' class="form-border form-customer" method="post" action="{{ route('admin.fe.post.register')}}">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h5 class="modal-title">Đăng ký nếu như chưa có tài khoản</h5>
                                    </div>
                                    <div class="modal-body osahan-my-cart">
                                        <div class="row">
                                            <div class="col-6 pb-3">
                                                <div class="form-group">
                                                    <label for="name" class="form-label font-weight-bold small">Tên</label>
                                                    <div class="input-group">
                                                        <input placeholder="Tên" type="text" name="name" id="name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 pb-3">
                                                <div class="form-group">
                                                    <label for="email" class="form-label font-weight-bold small">Email</label>
                                                    <div class="input-group">
                                                        <input placeholder="Email" type="email" name="email" id="email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 border-top py-3">
                                                <div class="form-group">
                                                    <label for="cmnd" class="form-label font-weight-bold small">CMND</label>
                                                    <div class="input-group">
                                                        <input placeholder="CMND" type="text" name="cmnd" id="cmnd" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 border-top py-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label font-weight-bold small">phone</label>
                                                    <div class="input-group">
                                                        <input placeholder="Phone" type="text" name="phone" id="phone" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 border-top py-3">
                                                <div class="form-group">
                                                    <label for="address" class="form-label font-weight-bold small">Địa chỉ</label>
                                                    <div class="input-group">
                                                        <input placeholder="Địa chỉ" type="text" name="address" id="address" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 border-top pt-3">
                                                <div class="form-group">
                                                    <label for="password" class="form-label font-weight-bold small">Password</label>
                                                    <div class="input-group">
                                                        <input placeholder="Password" type="password" name="password" id="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 border-top pt-3">
                                                <div class="form-group">
                                                    <label for="password_confirmation" class="form-label font-weight-bold small">Password confirmation</label>
                                                    <div class="input-group">
                                                        <input placeholder="Password confirmation" type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ URL::current() }}" name="route">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start osahan-my-cart-footer">
                                        <button type="submit" id="" class="btn btn-primary btn-block">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="{{ !empty($ceo) ? 'col-md-6' : 'col-md-8' }} card-right">
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
                                    <button data-id="{{$service_type->id}}" data-name_link="{{$service_type->service_name_link}}" id="btn-service-create" {{ empty($ceo) ? 'disabled' : '' }} class="btn btn-primary btn-block">Tiếp tục</button>
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
@include('admin.fe.service.script_hire')
@stop