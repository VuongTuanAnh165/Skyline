@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.promotion.create.title') )
@section('addcss')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
    <style>
        .radio-type {
            margin-right: 5%;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.admin.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
            ['title' => __('messages.admin.promotion.title'), 'url' => route('restaurant.promotion.index')],
            ['title' => __('messages.admin.promotion.create.title'), 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  __('messages.admin.promotion.create.title') }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('restaurant.promotion.store') }}" class="form-customer" enctype="multipart/form-data">
        @include('restaurant.admin.promotion.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('restaurant.admin.promotion.script_form')
@stop