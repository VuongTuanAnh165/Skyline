@extends('restaurant.admin.layouts.master')
@section('title', 'Bàn ăn' )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/branch/form.css') }}">
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
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => __('messages.admin.branch.title'), 'url' => route('restaurant.branch.index')],
                ['title' => 'Bàn ăn', 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bàn ăn - (Chi nhánh số {{ $branch->name }})</h1>
            </div>
            <div class="col-sm-6 text-right">
                <div data-toggle="modal" data-target="#modalFormTable" data-url="{{route('restaurant.table.store', ['branch_id' => $branch->id])}}" class="m-0 btn bg-gradient-success btn-lg btn-modal-form">{{ __('messages.admin.table.create') }}</div>
            </div>
        </div>
    </div>
</div>
@include('restaurant.admin.branch.table.table')
@include('restaurant.admin.branch.table.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'branch';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('restaurant.admin.branch.table.script')
    @include('restaurant.admin.branch.table.script_form')
@stop