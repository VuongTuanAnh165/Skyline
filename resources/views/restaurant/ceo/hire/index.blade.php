@extends('restaurant.ceo.layouts.master')
@section('title', __('messages.admin.home') )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/ceo/style.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.ceo.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('ceo.home.index')],
            ['title' => 'Đăng ký dịch vụ', 'url' => '#']
        ]
    ])
@stop
<div class="content content-hire">
    <div class="container-fluid">
        <div class="hire-service">
            <div style="font-size: 1.125em; margin-bottom: 12px" class="font-weight-bolder">Các dịch vụ của Sky Line</div>
            <div class="service-group-list">
                @foreach($service_groups as $item)
                <a href="javascript:void(0)" class="service-group-item item-list" data-name="{{$item->name}}" data-id="{{$item->id}}">
                    <img src="{{ !empty($item->image) ? asset('storage/'.$item->image) : '' }}">
                    <span>{{$item->name}}</span>
                </a>
                @endforeach
            </div>
            <div style="font-size: 1.125em; margin:30px 0 12px" class="font-weight-bolder select-service display-none">Chọn gói dịch vụ: <span></span></div>
            <div class="row service-list">
            </div>
            <div style="font-size: 1.125em; margin:30px 0 12px" class="font-weight-bolder select-type display-none">Chọn loại dịch vụ: <span></span></div>
            <div class="row service-type-list">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
@stop
@section('addjs')
    @include('restaurant.ceo.hire.script')
@stop