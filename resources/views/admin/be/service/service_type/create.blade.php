@extends('admin.be.layouts.master')
@section('title', __('messages.admin.service_type.create.title') )
@section('addcss')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .radio-type {
            margin-right: 5%;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
@include('admin.be.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
            ['title' => __('messages.admin.service.title'), 'url' => route('admin.service.index')],
            ['title' => __('messages.admin.service_type.create.title'), 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  __('messages.admin.service_type.create.title') . ': ' . $service->name }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('admin.service_type.store', ['id_service' => $service->id]) }}" class="form-customer" enctype="multipart/form-data">
        @include('admin.be.service.service_type.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('admin.be.service.service_type.script_form')
@stop