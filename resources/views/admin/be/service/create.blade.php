@extends('admin.be.layouts.master')
@section('title', __('messages.admin.service.create.title') )
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
@include('admin.be.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
            ['title' => __('messages.admin.service.title'), 'url' => route('admin.service.index')],
            ['title' => __('messages.admin.service.create.title'), 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  __('messages.admin.service.create.title') }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('admin.service.store') }}" class="form-customer" enctype="multipart/form-data">
        @include('admin.be.service.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('admin.be.service.script_form')
@stop