@extends('restaurant.admin.layouts.master')
@section('title', $messages['dish']['create']['title'] )
@section('addcss')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
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
            ['title' => __('messages.admin.dish.title'), 'url' => route('restaurant.dish.index')],
            ['title' => $messages['dish']['create']['title'], 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  $messages['dish']['create']['title'] }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('restaurant.dish.store') }}" class="form-customer" enctype="multipart/form-data">
        @include('restaurant.admin.dish.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('restaurant.admin.dish.script_form')
@stop