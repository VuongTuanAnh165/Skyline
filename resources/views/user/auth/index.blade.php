@extends('user.layouts.master')
@section('title', 'Đăng nhập - Đăng ký' )
@section('addcss')
<style>
    .main__header {
        background: var(--white-color);
    }
</style>
@stop
@section('content')
<!-- Start login section  -->
<div class="login__section section--padding mb-80">
    <div class="container">
        <div class="login__section--inner">
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <form id="login" class="account__login login" method="post" action="{{ route('user.login')}}">
                        {{ csrf_field() }}
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title h3 mb-10">Đăng nhập</h2>
                            <p class="account__login--header__desc">Đăng nhập nếu bạn là khách hàng cũ.</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Email" name="email" type="email" value="{{ old('email') ? old('email') : '' }}">
                                @if ($errors->first('email'))
                                    <div class="error error-be">{{ $errors->first('email') }}</div>
                                @endif
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Mật khẩu" name="password" type="password" value="{{ old('password') ? old('password') : '' }}">
                                @if ($errors->first('password'))
                                    <div class="error error-be">{{ $errors->first('password') }}</div>
                                @endif
                            </label>
                            <input type="hidden" value="{{ $prev }}" name="route">
                            <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                <div class="account__login--remember position__relative">
                                    <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <label class="checkout__checkbox--label login__remember--label" for="check1">
                                        Remember me</label>
                                </div>
                                <button class="account__login--forgot" type="submit">Quên mật khẩu?</button>
                            </div>
                            <button class="account__login--btn btn" type="submit">Đăng nhập</button>
                            <div class="account__login--divide">
                                <span class="account__login--divide__text">OR</span>
                            </div>
                            <div class="account__social d-flex justify-content-center mb-15">
                                <a class="account__social--link facebook" target="_blank" href="https://www.facebook.com">Facebook</a>
                                <a class="account__social--link google" target="_blank" href="https://www.google.com">Google</a>
                                <a class="account__social--link twitter" target="_blank" href="https://twitter.com">Twitter</a>
                            </div>
                            <p class="account__login--signup__text">Bạn chưa có tài khoản? <button>Đăng ký ngay</button></p>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form id="register" class="account__login register" method="post" action="{{ route('user.register') }}">
                        {{ csrf_field() }}
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title h3 mb-10">Tạo tài khoản</h2>
                            <p class="account__login--header__desc">Đăng ký tại đây nếu bạn là khách hàng mới</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Họ tên" name="name" type="text" value="{{ old('name') ? old('name') : '' }}">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Email" name="email" type="email" value="{{ old('email') ? old('email') : '' }}">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Mật khẩu" name="password" type="password" value="{{ old('password') ? old('password') : '' }}">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Nhập lại mật khẩu" name="password_confirmation" type="password" value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}">
                            </label>
                            <input type="hidden" value="{{ $prev }}" name="route">
                            <div class="account__login--remember position__relative mb-10">
                                <input class="checkout__checkbox--input" id="check2" type="checkbox" checked>
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label login__remember--label" for="check2">
                                    Tôi đã đọc và đồng ý với các điều khoản và điều kiện</label>
                            </div>
                            <button class="account__login--btn btn" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End login section  -->
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('user.partials.script.toastr')
@endif

@stop