@extends('restaurant.admin.layouts.master')
@section('title', $messages['dish']['title'] )
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
    </style>
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => $messages['dish']['title'], 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $messages['dish']['title'] }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('restaurant.category.index') }}" class="m-0 btn bg-gradient-warning btn-lg">{{ $messages['category']['title'] }}</a>
                <a href="{{ route('restaurant.menu') }}"  class="m-0 btn btn-danger btn-lg">
                    <i class="fas fa-ellipsis-v"></i>
                    {{ $messages['menu']['title'] }}
                </a>
                <a href="{{ route('restaurant.dish.create') }}" class="m-0 btn bg-gradient-success btn-lg">{{ __('messages.admin.table.create') }}</a>
            </div>
        </div>
    </div>
</div>
@include('restaurant.admin.dish.table')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'dish';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('restaurant.admin.dish.script')
@stop