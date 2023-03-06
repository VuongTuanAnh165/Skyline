@extends('user.layouts.master')
@section('content')
<!-- main header -->
@include('user.restaurant.header')
<!-- end main header -->
<!-- main content -->
@yield('content_restaurant')
<!-- end main content -->
@stop