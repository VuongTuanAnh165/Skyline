@extends('restaurant.sell.layouts.master')
@section('title', 'Sửa hóa đơn' )
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_sell/eat/style.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
        @include('restaurant.sell.restaurant.eat.form')
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif
@include('restaurant.sell.restaurant.eat.script_form')
@stop