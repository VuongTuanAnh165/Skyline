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
            <div class="row row-cols-md-2 row-cols-1 justify-content-center">
                <div class="col">
                    <form id="verify" class="account__login verify" method="post" action="{{ route('user.verify.store', ['id' => $id])}}">
                        {{ csrf_field() }}
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title h3 mb-10">Mã xác nhận</h2>
                            <p class="account__login--header__desc">Nhập mã xác nhận được gửi tới email của bạn.</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Mã code" name="code" type="text" value="{{ old('code') ? old('code') : '' }}">
                                @if ($errors->first('code'))
                                    <div class="error error-be">{{ $errors->first('code') }}</div>
                                @endif
                            </label>
                            <input type="hidden" value="{{ $prev }}" name="route">
                            <button class="account__login--btn btn" type="submit">Xác nhận</button>
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