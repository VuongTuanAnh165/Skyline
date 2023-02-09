@extends('admin.fe.layouts.master')
@section('title', $policy->name )
@section('addcss')
<style>

</style>
@stop
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- section begin -->
    <section id="subheader" class="jarallax">
        <img src="{{ asset('template_web_service/images/background/subheader.jpg') }}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{$policy->name}}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
    <section aria-label="section">
        <div class="container">
            {!! $policy->content !!}
        </div>
    </section>

</div>
<!-- content close -->
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('admin.fe.partials.script.toastr')
@endif
@stop