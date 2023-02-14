@extends('restaurant.sell.layouts.master')
@section('title', 'Thanh toán' )
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_sell/eat/style.css') }}">
@stop
@section('content')
<div class="container-header row">
    <a href="" class="col-md-6 alert alert-danger header-a">
        Tạo hóa đơn
    </a>
    <a href="" class="col-md-6 alert alert-secondary header-a">
        Hóa đơn
    </a>
</div>
<div style="padding-top: 55px;" class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin hóa đơn</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mã hóa đơn: </h5>

                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="">
                                    <p class="mb-1 text-danger">Bàn:</p>
                                    <ul class="mb-0 font-weight-bold text-dark">
                                        <li>bàn số 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="details-page border-top pt-3">
                                <h6 class="mb-3 text-danger">Chi tiết hóa đơn</h6>
                                <div class="d-flex align-items-center">
                                    <p class="bg-light rounded px-2 mr-3">2</p>
                                    <p class="text-dark">Large Pizza</p>
                                    <p class="ml-auto">$22</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="bg-light rounded px-2 mr-3">1</p>
                                    <p class="text-dark">Medium Fries</p>
                                    <p class="ml-auto">$4</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="bg-light rounded px-2 mr-3">1</p>
                                    <p class="text-dark">Coca Cola</p>
                                    <p class="ml-auto">$3</p>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center py-2 border-top">
                                    <p class="text-dark font-weight-bold m-0">Subtotal</p>
                                    <p class="ml-auto text-danger m-0">$52</p>
                                </div>
                                <div class="d-flex align-items-center pt-2 border-top">
                                    <p class="text-dark font-weight-bold m-0">Delivery fee</p>
                                    <p class="ml-auto text-danger m-0">$4</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <div class="row w-100">
                                <div class="col-3 px-0"><a href="detail.html" class="btn btn-warning btn-block">Tổng tiền</a></div>
                                <div class="col-9 pr-0"><a href="explore.html" class="btn btn-primary btn-block">1000000</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chương trình khuyến mãi (nếu có)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-body">
                            <div>
                                <div class="osahan-card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group" style="margin:0;">
                                                <label class="form-label small font-weight-bold">Chương trình khuyến mãi</label><br>
                                                <select class="custom-select form-control">
                                                    <option>Bank</option>
                                                    <option>KOTAK</option>
                                                    <option>SBI</option>
                                                    <option>UCO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-block">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hình thức thanh toán</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-footer justify-content-start">
                            <div class="row w-100">
                                <div class="col-6 px-0"><a href="detail.html" class="btn btn-warning btn-block">Thanh toán chuyển khoản</a></div>
                                <div class="col-6 pr-0"><a href="explore.html" class="btn btn-primary btn-block">Thanh toán tiền mặt</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tiền nhận</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body">
                                    <div class="osahan-card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-md-12 form-group" style="margin:0;">
                                                    <label class="form-label font-weight-bold small">Tiền nhận</label>
                                                    <div class="input-group">
                                                        <input placeholder="Tiền nhận" type="number" class="form-control">
                                                        <div class="input-group-append"><button id="button-addon2" type="button" class="btn btn-outline-secondary"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-block">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tiền trả lại</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-body">
                                    <div class="osahan-card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-md-12 form-group" style="margin:0;">
                                                    <label class="form-label font-weight-bold small">Tiền trả lại</label>
                                                    <div class="input-group">
                                                        <input placeholder="Tiền trả lại" disabled value="0" type="text" class="form-control">
                                                        <div class="input-group-append">
                                                            <button id="button-addon2" type="button" class="btn btn-outline-secondary" disabled>
                                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Xác nhận thanh toán chuyển khoản</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="modal-content-page">
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-warning btn-block">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif

@stop