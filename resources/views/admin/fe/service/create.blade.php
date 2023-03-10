@extends('admin.fe.layouts.master')
@section('title', $service_type->service_name )
@section('addcss')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .btn-block+.btn-block {
        margin: 0;
    }

    .error {
        color: red;
        margin: 0;
    }

    .success {
        color: green;
        margin: 0;
    }

    .active-background {
        background-color: #ffffff;
    }

    .img-fluid {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .bd-callout {
        padding: 1.25rem;
        margin-top: 1.25rem;
        margin-bottom: 1.25rem;
        border: 1px solid #eee;
        border-left-width: .25rem;
        border-radius: .25rem;
        background-color: #ffffff;
    }

    .bd-callout h4 {
        margin-top: 0;
        margin-bottom: .25rem
    }

    .bd-callout-danger {
        border-left-color: #c60021
    }

    .bd-callout-warning {
        border-left-color: #f6c23e
    }

    .span-callout {
        margin: 0 1rem;
    }

    .display-none {
        display: none;
    }

    .select2-container .select2-selection--multiple {
        height: 40px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #ffffff !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #ffffff;
        margin: 0;
    }

    .select2-selection__rendered {
        display: flex !important;
        align-items: center;
        height: 100%;
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
                        <p class="lead">{{$service->service_group_description}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section id="form-hire" class="mt-100 no-top content-profile">
        <div class="container">
            <div class="row">
                <div class="col-md-6 card-right">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                            <div class="row m-0">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Email ????ng k??</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body osahan-my-cart">
                                    <div class="form-group">
                                        <label for="email_service" class="form-label font-weight-bold small text-primary">Nh???p Email</label>
                                        <div class="input-group">
                                            <input placeholder="Nh???p email" type="email" name="email_service" id="email_service" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start osahan-my-cart-footer">
                                    <div class="row w-100">
                                        <div class="col-3 px-0">
                                            <button class="btn btn-primary btn-block check-email">Check Email</button>
                                            <button class="display-none btn btn-warning btn-block under-email">?????i Email</button>
                                        </div>
                                        <div class="col-9 pr-0">
                                            <button class="btn btn-danger btn-block continue display-none">Ti???p t???c</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                            <div class="row m-0">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Th??ng tin d???ch v???</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body border-bottom">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{asset('storage/'.$service->image)}}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2">
                                            <h5 class="mb-0" style="margin-left: 16px;">D???ch v???: <span class="text-primary">{{$service->name}}</span></h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Lo???i d???ch v???: <span class="text-primary">{{$service_type->name}}</span></h5>
                                </div>
                                <div class="modal-body osahan-my-cart">
                                    <h5 class="modal-title">Ph?? d???ch v???: <span class="text-primary">{{ number_format($service_charge->price) }} VND / {{ $service_charge->month }} th??ng</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 card-left">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                            <div class="row m-0">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Th??ng tin c?? nh??n</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body border-bottom">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{ $ceo->avatar ? asset('storage/'.$ceo->avatar) : asset('img/avatar_default.png') }}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2" style="margin-left: 16px;">
                                            <h5 class="mb-0">H??? t??n: <span class="text-primary">{{$ceo->name}}</span></h5>
                                            <span class="mb-0 small text-black-50">Email: <span class="text-primary">{{$ceo->email}}</span></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="modal-header">
                                    <h5 class="modal-title">CMND: <span class="text-primary">{{$ceo->cmnd}}</span></h5>
                                    <h5 class="modal-title">S??T: <span class="text-primary">{{$ceo->phone}}</span></h5>
                                </div>
                                <div class="modal-body osahan-my-cart">
                                    <h5 class="modal-title">?????a ch???: <span class="text-primary">{{$ceo->address}}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
    $nowDate = Carbon\Carbon::now();
    @endphp
    <section id="form-hire" class="mt-100 no-top content-order display-none">
        <div class="container">
            <div class="bd-callout bd-callout-danger shadow" style="display: flex;
                justify-content: space-between;
                align-items: center;">
                <div>
                    <h4 class="text-danger">L??u ??</h4>
                    <b class="text-danger">H??y ??i???n ????ng ?????a ch??? email c???a b???n. B???i v?? ch??ng t??i s??? cung c???p password g???i ?????n email c???a b???n.</b>
                </div>
                <div>
                    <button class="btn btn-danger btn-block back">Tr??? l???i</button>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: rgba(0,0,0,.03);">
                    <div class="row m-0">
                        <h6 class="col-6 m-0 font-weight-bold text-primary" style="text-align: left;">Chi ti???t h??a ????n</h6>
                        <h6 class="col-6 m-0 font-weight-bold text-primary" style="text-align: right;">Ng??y: {{$nowDate->toDateString()}}</h6>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-header" style="display: block;">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{asset('template_web_service/images/icon.png')}}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2" style="margin-left: 16px;">
                                            <h5 class="mb-0">Admin: <span class="text-primary">{{$skyline->name}}</span></h5>
                                            <span class="mb-0 small text-black-50">From</span>
                                        </div>
                                    </a>
                                    <p class="mb-1 small">?????a ch???: <span class="text-primary">{{$skyline->address}}</span></p>
                                    <p class="mb-1 small">S??T: <span class="text-primary">{{$skyline->phone}}</span></p>
                                    <p class="mb-1 small">Email: <span class="text-primary">{{$skyline->email}}</span></p>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                        <div class="mr-2"><img src="{{asset('storage/'.$ceo->avatar)}}" class="img-fluid rounded-circle"></div>
                                        <div class="ml-2" style="margin-left: 16px;">
                                            <h5 class="mb-0"><span class="text-primary">{{ $ceo->name }}</span></h5>
                                            <span class="mb-0 small text-black-50">To</span>
                                        </div>
                                    </a>
                                    <p class="mb-1 small">?????a ch???: <span class="text-primary">{{ $ceo->address }}</span></p>
                                    <p class="mb-1 small">S??T: <span class="text-primary">{{$ceo->phone}}</span></p>
                                    <p class="mb-1 small">Email: <span class="text-primary">{{$ceo->email}}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-header">
                            @php
                            $str = str_replace('-', '', $nowDate->toDateTimeString());
                            $str = str_replace(':', '', $str);
                            $str = str_replace(' ', '', $str);
                            $order_id = Illuminate\Support\Str::random(5) . '_' . $str;
                            @endphp
                            <input type="hidden" id="order_id" value="{{$order_id}}">
                            <h5 class="modal-title">ID h??a ????n: <span class="text-primary">{{$order_id}}</span></h5>
                        </div>
                        <div class="modal-body border-bottom pt-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-primary">ID d???ch v???</th>
                                        <th class="text-primary">T??n d???ch v???</th>
                                        <th class="text-primary">Lo???i</th>
                                        <th class="text-primary">Th???i h???n</th>
                                        <th class="text-primary">M?? t???</th>
                                        <th class="text-primary">Email ????ng nh???p</th>
                                        <th class="text-primary">Gi??</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$service->id}}</td>
                                        <td>{{$service->name}}</td>
                                        <td>{{$service_type->name}}</td>
                                        <td>{{$service_charge->month}} th??ng</td>
                                        <td>{!! $service->content !!}</td>
                                        <td class="table-check-email"></td>
                                        <td>{{number_format($service_charge->price)}} VND</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer justify-content-start osahan-my-cart-footer">
                            <div class="row w-100">
                                <div class="col-6 px-0">
                                    <b class="modal-title text-primary">Ph????ng th???c thanh to??n:</b>
                                    <div id="paypal-button-container"></div>
                                </div>
                                <div class="col-6 pr-0">
                                    <p class="modal-title text-primary">H??a ????n ng??y: {{$nowDate->toDateString()}}</p>
                                    <div class="modal-header">
                                        <b>T???ng ph???: <span class="text-primary">{{number_format($service_charge->price)}} VND</span></b>
                                    </div>
                                    <div class="modal-header" style="display: block;">
                                        <b>Ch???n ch????ng tr??nh khuy???n m??i:</b>
                                        <select class="form-control select2 promotion_id" multiple id="promotion_id" name="promotion_id">
                                            <option value="">Ch???n ch????ng tr??nh khuy???n m??i</option>
                                            @if($promotions && count($promotions) > 0)
                                            @foreach($promotions as $promotion)
                                            <option value="{{$promotion->id}}">{{$promotion->name}} (Gi???m {{$promotion->value}} %)</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="modal-header">
                                        <b>Th??nh ti???n: <span class="text-primary total">{{number_format($service_charge->price)}} VND</span></b>
                                    </div>
                                    <input type="hidden" id="subtotal" name="subtotal" value="{{$service_charge->price}}">
                                    <input type="hidden" id="total" name="total" value="{{$service_charge->price}}">
                                    <input type="hidden" id="service_charge_id" value="{{$service_charge->id}}">
                                    <input type="hidden" id="implementation_date" name="implementation_date" value="{{$nowDate->toDateString()}}">
                                    <input type="hidden" id="email" name="email" value="{{ $ceo->email }}">
                                    <input type="hidden" id="url-thanks" value="{{ route('admin.fe.service.thankyou', ['id' => $service_type->id, 'name_link' => $service->name_link]) }}">
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
@include('admin.fe.service.script_form')
@stop