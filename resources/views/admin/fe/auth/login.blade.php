@extends('admin.fe.layouts.master')
@section('title', __('messages.admin.login.title'))
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_service/auth/form.css') }}">
@stop
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <section id="section-hero" class="section-hero-login full-height no-top no-bottom" aria-label="section">
        <div class="v-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="padding40 rounded-3 shadow-soft text-center" data-bgcolor="#ffffff">
                            <h4>Sky Line<br>Dịch vụ tốt nhất cho bạn</h4>
                            <div class="spacer-10"></div>
                            <form id="form_register" class="form-border form-customer" method="post" action="{{ route('admin.fe.post.login')}}">
                                {{ csrf_field() }}
                                <div class="field-set">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : '' }}" placeholder="Nhập Email" />
                                    @if ($errors->first('email'))
                                    <div class="error error-be">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="field-set">
                                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') ? old('password') : '' }}" placeholder="Nhập Password" />
                                    @if ($errors->first('password'))
                                    <div class="error error-be">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div id="submit">
                                    <button type="submit" id="send_message" class="btn-main btn-fullwidth rounded-3">Đăng nhập</button>
                                </div>
                            </form>
                            <div class="title-line">Or&nbsp;sign&nbsp;up&nbsp;with</div>
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <a class="btn-sc btn-fullwidth mb10" href="#"><img src="{{ asset('template_web_service/images/svg/google_icon.svg') }}" alt="">Google</a>
                                </div>
                                <div class="col-lg-6">
                                    <a class="btn-sc btn-fullwidth mb10" href="#"><img src="{{ asset('template_web_service/images/svg/facebook_icon.svg') }}" alt="">Facebook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- content close -->
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@include('admin.fe.auth.script')
@stop