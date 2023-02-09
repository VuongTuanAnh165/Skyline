@extends('restaurant.ceo.layouts.master')
@section('title', 'Quản lý câu hỏi' )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/table.css') }}">
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
                ['title' => 'Quản lý câu hỏi', 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Quản lý câu hỏi</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('ceo.help.create')}}" class="m-0 btn bg-gradient-success btn-lg">Gửi câu hỏi</a>
            </div>
        </div>
    </div>
</div>
@include('restaurant.ceo.help.table')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.ceo.partials.script.toastr')
    @endif
    @include('restaurant.ceo.help.script')
@stop