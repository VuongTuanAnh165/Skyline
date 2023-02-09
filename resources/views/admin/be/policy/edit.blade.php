@extends('admin.be.layouts.master')
@section('title', __('messages.admin.policy.edit.title') )
@section('addcss')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">  
@stop
@section('content')
@section('addBreadcrumb')
@include('admin.be.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
            ['title' => __('messages.admin.policy.title'), 'url' => route('admin.policy.index')],
            ['title' => __('messages.admin.policy.edit.title'), 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{  __('messages.admin.policy.edit.title') }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('admin.policy.update', ['id' => $data->id]) }}" class="form-customer" enctype="multipart/form-data">
        @include('admin.be.policy.form')
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('admin.be.policy.script_form')
@stop