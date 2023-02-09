@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.branch.showTitle') )
@section('addcss')
<link rel="stylesheet" href="{{ asset('css/web_admin/branch/form.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
<!-- CodeMirror -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet">
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.admin.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
            ['title' => __('messages.admin.branch.title'), 'url' => route('restaurant.branch.index')],
            ['title' => __('messages.admin.branch.showTitle'), 'url' => '#'],
        ]
    ])
@stop

<!-- Main content -->
<section class="content branch-show-content">
    <div class="row">
        <div class="col-12 col-sm-5">
            @if($data->background)
            <div class="col-12 product-image-background">
                <img src="{{asset('storage/'. $data->background[0])}}" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
                @foreach($data->background as $value)
                <div class="product-image-thumb {{ ($background == $value) ? 'active' : ''}}"><img src="{{asset('storage/'. $value)}}" alt="Product Image"></div>
                @endforeach
            </div>
            @else
            <div class="col-12">
                <img src="{{ asset('img/background_default.jpg') }}" class="product-image" alt="Product Image">
            </div>
            @endif
        </div>
        <div class="col-12 col-sm-5">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.admin.branch.showTitle') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong> {{ __('messages.admin.branch.table.name') }}</strong>
                    <p class="text-muted">
                        {{ $data->name }}
                    </p>
                    <hr>
                    <strong> {{ __('messages.admin.branch.table.address') }}</strong>
                    <p class="text-muted">{{ $data->address }}</p>
                    <input type="hidden" name="longitude" id="longitude" value="{{ isset($data->longitude) ? $data->longitude : '' }}" class="form-control">
                    <input type="hidden" name="latitude" id="latitude" value="{{ isset($data->latitude) ? $data->latitude : '' }}" class="form-control">
                    <div wire:ignore id="map" style='width: 100%; height: 30vh;' ></div>
                    <hr>
                    <strong> {{ __('messages.admin.branch.table.open_time') }}</strong>
                    <p class="text-muted">{{ $data->open_time }}</p>
                    <hr>
                    <strong> {{ __('messages.admin.branch.table.close_time') }}</strong>
                    <p class="text-muted">{{ $data->close_time }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12 col-sm-2">
            <a class="btn btn-info btn-sm float-right" href="{{ route('restaurant.branch.edit', ['id' => $data->id]) }}">
                <i class="fas fa-pencil-alt"></i>
                {{ __('messages.admin.table.edit') }}
            </a>
        </div>
    </div>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    @include('restaurant.admin.branch.script')
    @include('restaurant.admin.branch.script_map')
@stop