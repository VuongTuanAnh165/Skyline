@extends('admin.be.layouts.master')
@section('title', __('messages.admin.image.title') )
@section('addcss')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
    <style>
        .modal-dialog {
            max-width: 650px;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('admin.be.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
                ['title' => __('messages.admin.image.title'), 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('messages.admin.image.title') }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <div data-toggle="modal" data-target="#modalFormimage" data-url="{{route('admin.image.store')}}" class="m-0 btn bg-gradient-success btn-lg btn-modal-form">{{ __('messages.admin.table.create') }}</div>
            </div>
        </div>
    </div>
</div>
@include('admin.be.image.table')
@include('admin.be.image.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('admin.be.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'image';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('admin.be.image.script')
    @include('admin.be.image.script_form')
@stop