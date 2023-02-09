@extends('restaurant.admin.layouts.master')
@php
    $personnel_title = Auth::guard('personnel')->user() ? __('messages.admin.personnel.show.title') : __('messages.admin.personnel.edit.title');
@endphp
@section('title', $personnel_title )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/form.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @if(Auth::guard('personnel')->user())
        <link rel="stylesheet" href="{{ asset('css/web_admin/restaurant/form.css') }}">
    @endif
@stop
@section('content')
@section('addBreadcrumb')
@if(Auth::guard('personnel')->user())
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => $personnel_title, 'url' => '#']
            ]
        ])
@else 
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => __('messages.admin.personnel.title'), 'url' => route('restaurant.personnel.index')],
                ['title' => $personnel_title, 'url' => '#']
            ]
        ])
@endif
@stop       

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $personnel_title }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                @if(Auth::guard('personnel')->user())
                <div data-toggle="modal" data-target="#modalChangePassword" class="btn bg-gradient-warning btn-sm">
                    <i class="fas fa-key"></i>
                    {{ __('messages.admin.restaurant.changePassword') }}
                </div>
                <div class="modal fade modal-add-timekeeping" id="modalChangePassword" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('messages.admin.restaurant.changePassword') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="choose_time">{{ __('messages.admin.restaurant.password_old') }}</label>
                                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                                <input class="input100" type="password" id="password_old" name="password_old" placeholder="{{ __('messages.admin.restaurant.password_old') }}">
                                                <span class="focus-input100"></span>
                                                <label class="label-form">
                                                    <img src="{{ asset('img/password_icon.svg') }}">
                                                </label>
                                                <label class="label-eye-form" id="eye-old">
                                                    <img src="{{ asset('img/eye_close.svg') }}">
                                                </label>
                                            </div>
                                            @if ($errors->first('password_old'))
                                            <div class="error error-be">{{ $errors->first('password_old') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="choose_time">{{ __('messages.admin.restaurant.password') }}</label>
                                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                                <input class="input100" type="password" id="password" name="password" placeholder="{{ __('messages.admin.restaurant.password') }}">
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
                                        </div>
                                        <div class="col-12">
                                            <label for="choose_time">{{ __('messages.admin.restaurant.password_confirmation') }}</label>
                                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                                <input class="input100" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('messages.admin.restaurant.password_confirmation') }}">
                                                <span class="focus-input100"></span>
                                                <label class="label-form">
                                                    <img src="{{ asset('img/password_icon.svg') }}">
                                                </label>
                                                <label class="label-eye-form" id="eye-confirmation">
                                                    <img src="{{ asset('img/eye_close.svg') }}">
                                                </label>
                                            </div>
                                            @if ($errors->first('password_confirmation'))
                                            <div class="error error-be">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div id="btn-change-password" class="btn btn-primary"><i class="fas fa-key"></i> {{ __('messages.admin.restaurant.changePassword') }}</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('restaurant.personnel.update', ['id' => $data->id]) }}" class="form-customer" enctype="multipart/form-data">
        @include('restaurant.admin.personnel.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('restaurant.admin.personnel.script_form')
    @if(Auth::guard('personnel')->user())
        @include('restaurant.admin.personnel.script_personnel')
    @endif
@stop