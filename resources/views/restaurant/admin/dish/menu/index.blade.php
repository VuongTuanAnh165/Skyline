@extends('restaurant.admin.layouts.master')
@section('title', $messages['menu']['title'] )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/shift/form.css') }}">
    <style>
        .form-group-button {
            margin: 5px 0px;
        }
        .dish-menu {
            margin: 5px;
        }
        .modal.show .modal-dialog {
            max-width: 60%;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => $messages['dish']['title'], 'url' => route('restaurant.dish.index')],
                ['title' => $messages['menu']['title'], 'url' => route('restaurant.dish.index')],
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $messages['menu']['title'] }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalFormMenu" class="m-0 btn bg-gradient-success btn-lg show-dish-menu">Chỉnh sửa</a>
            </div>
        </div>
    </div>
</div>
@include('restaurant.admin.dish.menu.table')
@include('restaurant.admin.dish.menu.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    @include('restaurant.admin.dish.menu.script')
@stop