@extends('admin.be.layouts.master')
@section('title', __('messages.admin.category.title') )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
    @include('admin.be.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('admin.home.index')],
                ['title' => __('messages.admin.category_home.title'), 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('messages.admin.category_home.title') }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <div data-toggle="modal" data-target="#modalFormCategory" data-url="{{route('admin.category.store')}}" class="m-0 btn bg-gradient-success btn-lg btn-modal-form">{{ __('messages.admin.table.create') }}</div>
            </div>
        </div>
    </div>
</div>
@include('admin.be.category.table')
@include('admin.be.category.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('admin.be.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'category_home';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('admin.be.category.script')
    @include('admin.be.category.script_form')
@stop