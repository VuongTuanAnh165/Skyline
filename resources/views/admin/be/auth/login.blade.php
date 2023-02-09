@extends('admin.be.auth.master')
@section('title', __('messages.admin.login.title'))
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/auth/form.css') }}">
@stop
@section('content')
<form action="{{ route('admin.post.login')}}" method="POST" class="login100-form validate-form form-customer">
    {{ csrf_field() }}
    <span class="login100-form-title">
        {{ __('messages.admin.login.title') }}
    </span>

    <div class="wrap-input100 validate-input">
        <input class="input100" type="text" id="email" name="email" placeholder="{{ __('messages.admin.login.email') }}">
        <span class="focus-input100"></span>
        <label class="label-form">
            <img src="{{ asset('img/email_icon.svg') }}">
        </label>
    </div>
    @if ($errors->first('email'))
        <div class="error error-be">{{ $errors->first('email') }}</div>
    @endif

    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" id="password" name="password" placeholder="{{ __('messages.admin.login.password') }}">
        <span class="focus-input100"></span>
        <label class="label-form">
            <img src="{{ asset('img/password_icon.svg') }}">
        </label>
        <label class="label-eye-form" id="eye">
            <img src="{{ asset('img/eye_close.svg') }}">
        </label>
    </div>
    @if ($errors->first('password'))
        <div class="error error-be">{{ $errors->first('password') }}</div>
    @endif

    <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">
            {{ __('messages.admin.login.submitLogin') }}
        </button>
    </div>

    <div class="text-center p-t-12">
        <a class="txt2" href="#">
            {{ __('messages.admin.forgotPassword.title') }}
        </a>
    </div>

    <div class="text-center p-t-136">
    </div>
</form>
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('admin.be.partials.script.toastr')
    @endif
    @include('admin.be.auth.script')
@stop