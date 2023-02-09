@extends('restaurant.ceo.layouts.master')
@section('title', 'Hồ sơ cá nhân' )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/form.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/restaurant/form.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.ceo.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('ceo.home.index')],
            ['title' => 'Hồ sơ cá nhân', 'url' => '#']
        ]
    ])
@stop    

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6 text-right">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('ceo.profile.update') }}" class="form-customer" enctype="multipart/form-data">
        @include('restaurant.ceo.profile.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.ceo.partials.script.toastr')
    @endif
    @include('restaurant.ceo.profile.script_form')
@stop