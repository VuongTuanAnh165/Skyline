@extends('admin.fe.layouts.master')
@section('title', $service_type->service_name )
@section('addcss')
<style>
    .wrapper-1 {
		width: 100%;
		height: 100vh;
		display: flex;
		flex-direction: column;
	}

	.wrapper-2 {
		padding: 30px;
		text-align: center;
        background-color: #ffffff;
	}

	.wrapper-1 h1 {
		font-family: 'Kaushan Script', cursive;
		font-size: 4em;
		letter-spacing: 3px;
		color: #5892FF;
		margin: 0;
		margin-bottom: 20px;
	}

	.wrapper-2 p {
		margin: 0;
		font-size: 1.3em;
		color: #aaa;
		font-family: 'Source Sans Pro', sans-serif;
		letter-spacing: 1px;
	}

	.go-home {
		color: #fff;
		background: #5892FF;
		border: none;
		padding: 10px 50px;
		margin: 30px 0;
		border-radius: 30px;
		text-transform: capitalize;
		box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
	}

	.footer-like {
		margin-top: auto;
		background: #D7E6FE;
		padding: 6px;
		text-align: center;
	}

	.footer-like p {
		margin: 0;
		padding: 4px;
		color: #5892FF;
		font-family: 'Source Sans Pro', sans-serif;
		letter-spacing: 1px;
	}

	.footer-like p a {
		text-decoration: none;
		color: #5892FF;
		font-weight: 600;
	}

	@media (min-width:360px) {
		.wrapper-1 h1 {
			font-size: 4.5em;
		}

		.go-home {
			margin-bottom: 20px;
		}
	}

	@media (min-width:600px) {
		.content {
			max-width: 1000px;
			margin: 0 auto;
		}

		.wrapper-1 {
			height: initial;
			max-width: 620px;
			margin: 0 auto;
			margin-top: 50px;
			box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
		}

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

    <section id="section-hero" class="no-top mt-100" aria-label="section">
        <div class="container">
            <div class="content content-hire">
                <div class="container-fluid">
                    <div class="wrapper-1">
                        <div class="wrapper-2">
                            <h1>Thank you !</h1>
                            <p>Thanks for subscribing to our news letter. </p>
                            <p>you should receive a confirmation email soon </p>
                            <a href="{{route('admin.fe.home.index')}}">
                                <button class="go-home">
                                    Trang chủ
                                </button>
                            </a>
                        </div>
                        <div class="footer-like">
                            <p>Tiếp tục đăng ký thêm dịch vụ?
                                <a href="{{route('admin.fe.home.index')}}">Click here</a>
                            </p>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </section>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@stop