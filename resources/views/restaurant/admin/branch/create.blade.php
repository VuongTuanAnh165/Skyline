@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.branch.create.title'))
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/branch/form.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css">
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <style>
        .mapboxgl-ctrl-geocoder input[type='text'] {
            padding: 10px 10px 10px 35px;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs', [
        'breadcrumb' => [
            ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
            ['title' => __('messages.admin.branch.title'), 'url' => route('restaurant.branch.index')],
            ['title' => __('messages.admin.branch.create.title'), 'url' => '#'],
        ],
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('messages.admin.branch.create.title') }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('restaurant.branch.store') }}" class="form-customer"
        enctype="multipart/form-data">
        @include('restaurant.admin.branch.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
@include('restaurant.admin.branch.script_form')
@include('restaurant.admin.branch.script_map')
@stop
