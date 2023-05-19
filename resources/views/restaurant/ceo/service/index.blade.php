@extends('restaurant.ceo.layouts.master')
@section('title', 'Dịch vụ của tôi' )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
    
    <style>
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.ceo.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('ceo.home.index')],
                ['title' => 'Dịch vụ của tôi', 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dịch vụ của tôi</h1>
            </div>
        </div>
    </div>
</div>
@include('restaurant.ceo.service.table')
@include('restaurant.ceo.service.rating.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.ceo.partials.script.toastr')
    @endif
    @include('restaurant.ceo.service.script')
    @include('restaurant.ceo.service.rating.script')
@stop