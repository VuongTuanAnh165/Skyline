@extends('restaurant.admin.layouts.master')
@section('title', $messages['menu']['title'] )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/web_admin/dish/style.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => $messages['dish']['title'], 'url' => route('restaurant.dish.index')],
                ['title' => $messages['menu']['title'], 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $messages['menu']['title'] }}: {{$menu->dish_name}} (Loại: {{$menu->name}})</h1>
            </div>
            <div class="col-sm-6 text-right">
                <div data-toggle="modal" data-target="#modalFormItem" data-url="{{route('restaurant.menu.itemStore', ['menu_id' => $menu->id])}}" class="m-0 btn bg-gradient-success btn-lg btn-modal-form">{{ __('messages.admin.table.create') }}</div>
            </div>
        </div>
    </div>
</div>
@include('restaurant.admin.dish.menu.item.table')
@include('restaurant.admin.dish.menu.item.form')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'menu_item';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('restaurant.admin.dish.menu.item.script')
    @include('restaurant.admin.dish.menu.item.script_form')
@stop