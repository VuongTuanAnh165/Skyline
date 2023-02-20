@extends('restaurant.sell.auth.master')
@section('title', 'Đăng nhập')
@section('addcss')

@stop
@section('content')
<div class="col-md-6 d-flex justify-content-center flex-column px-0">
    <div class="col-lg-6 mx-auto box-shadow">
        <h3 class="mb-1">Phần mềm bán hàng Sky Line</h3>
        <p class="mb-5">Đăng nhập vào tài khoản của bạn để tiếp tục</p>
        <form action="{{ route('sell.post.login')}}" method="POST" class="form-customer">
            {{ csrf_field() }}
            <div class="d-flex align-items-center">
                <div class="mr-3 bg-light rounded p-2 osahan-icon"><i class="mdi mdi-email-outline"></i></div>
                <div class="w-100">
                    <p class="mb-0 small font-weight-bold text-dark">Email</p>
                    <input type="email" name="email" class="form-control form-control-sm p-0 border-input border-0 rounded-0" value="{{ old('email') ? old('email') : '' }}" placeholder="Enter Your Email">
                </div>
            </div>
            @if ($errors->first('email'))
                <div class="error error-be">{{ $errors->first('email') }}</div>
            @endif
            <div class="d-flex align-items-center mt-4">
                <div class="mr-3 bg-light rounded p-2 osahan-icon"><i class="mdi mdi-form-textbox-password"></i></div>
                <div class="w-100">
                    <p class="mb-0 small font-weight-bold text-dark">Password</p>
                    <input type="password" name="password" class="form-control form-control-sm p-0 border-input border-0 rounded-0" value="{{ old('password') ? old('password') : '' }}" placeholder="Enter Password">
                </div>
            </div>
            @if ($errors->first('password'))
                <div class="error error-be">{{ $errors->first('password') }}</div>
            @endif
            <div class="mb-3 mt-4">
                <button type="submit" class="btn btn-primary btn-block mb-3">Đăng nhập</button>
            </div>
        </form>
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif
@include('restaurant.sell.auth.script')
@stop