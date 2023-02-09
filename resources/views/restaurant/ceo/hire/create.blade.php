@extends('restaurant.ceo.layouts.master')
@section('title', 'Đăng ký dịch vụ' )
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_admin/personnel/form.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .display-none {
        display: none;
    }
    .error {
        color: red;
    }
    .success {
        color: green;
    }
    .select2-container .select2-selection--single {
        height: 38.58px;
    }
</style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.ceo.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('ceo.home.index')],
                ['title' => 'Đăng ký dịch vụ', 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
   
</div>
@include('restaurant.ceo.hire.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.ceo.partials.script.toastr')
    @endif
    @include('restaurant.ceo.hire.script_form')
@stop