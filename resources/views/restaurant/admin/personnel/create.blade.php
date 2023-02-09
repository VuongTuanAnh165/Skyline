@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.personnel.create.title') )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/form.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.admin.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
            ['title' => __('messages.admin.personnel.title'), 'url' => route('restaurant.personnel.index')],
            ['title' => __('messages.admin.personnel.create.title'), 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  __('messages.admin.personnel.create.title') }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('restaurant.personnel.store') }}" class="form-customer" enctype="multipart/form-data">
        @include('restaurant.admin.personnel.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('restaurant.admin.personnel.script_form')
@stop