@extends('admin.fe.layouts.master')
@section('title', __('messages.admin.register.title'))
@section('addcss')
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
                        <h1>{{ __('messages.admin.register.title') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <section aria-label="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h3>Bạn chưa có tài khoản? Đăng ký ngay bây giờ.</h3>
                    <p>Dịch vụ tốt nhất cho bạn.</p>

                    <div class="spacer-10"></div>

                    <form name="contactForm" id='contact_form' class="form-border form-customer" method="post" action="{{ route('admin.fe.post.register')}}">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="name">Name:</label>
                                    <input type='text' name='name' id='name' value="{{ old('name') ? old('name') : '' }}" class="form-control">
                                    @if ($errors->first('name'))
                                    <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="email">Email:</label>
                                    <input type='email' name='email' id='email' value="{{ old('email') ? old('email') : '' }}" class="form-control">
                                    @if ($errors->first('email'))
                                    <div class="error error-be">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="cmnd">CMND:</label>
                                    <input type='text' name='cmnd' id='cmnd' value="{{ old('cmnd') ? old('cmnd') : '' }}" class="form-control">
                                    @if ($errors->first('cmnd'))
                                    <div class="error error-be">{{ $errors->first('cmnd') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="phone">Phone:</label>
                                    <input type='text' name='phone' id='phone' value="{{ old('phone') ? old('phone') : '' }}" class="form-control">
                                    @if ($errors->first('phone'))
                                    <div class="error error-be">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="field-set">
                                    <label for="address">Địa chỉ:</label>
                                    <input type='text' name='address' id='address' value="{{ old('address') ? old('address') : '' }}" class="form-control">
                                    @if ($errors->first('address'))
                                    <div class="error error-be">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="password">Password:</label>
                                    <input type='password' name='password' id='password' value="{{ old('password') ? old('password') : '' }}" class="form-control">
                                    @if ($errors->first('password'))
                                    <div class="error error-be">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <label for="password_confirmation">Re-enter Password:</label>
                                    <input type='password' name='password_confirmation' id='password_confirmation' value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}" class="form-control">
                                    @if ($errors->first('password_confirmation'))
                                    <div class="error error-be">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12">

                                <div id='submit' class="pull-left">
                                    <button type='submit' id='send_message' class="btn-main color-2">Đăng ký</button>
                                </div>

                                <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                <div class="clearfix"></div>

                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>


</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@include('admin.fe.auth.script')
@stop