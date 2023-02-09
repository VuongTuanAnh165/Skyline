@extends('admin.be.layouts.master')
@section('title', __('messages.admin.service_type.title') )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/shift/form.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
    @include('admin.be.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
                ['title' => __('messages.admin.service.title'), 'url' => route('admin.service.index')],
                ['title' => __('messages.admin.service_type.title'), 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('messages.admin.service_type.title') . ': ' . $service->name }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('admin.service_type.create', ['id_service' => $service->id])}}" class="m-0 btn bg-gradient-success btn-lg">{{ __('messages.admin.table.create') }}</a>
            </div>
        </div>
    </div>
</div>
@include('admin.be.service.service_type.table')
@include('admin.be.service.service_type.modal')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('admin.be.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'service_type';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('admin.be.service.service_type.script')
@stop