<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/master.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/admin_core.css?v=') . strtotime('now') }}">

    <link rel="shortcut icon" type="image/png" href="{{asset('template_web_service/images/icon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('template_web_service/images/icon.png')}}">
    @yield('addcss')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.be.layouts.header')
		@include('admin.be.layouts.aside')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@include('admin.be.layouts.footer')
    </div>
    <script src="{{ asset('template_web_admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/dist/js/adminlte.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('template_web_admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/web_admin/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/web_admin/admin_core.js?v=') . strtotime('now') }}"></script>
    <script src="{{ asset('template_web_admin/dist/js/demo.js') }}"></script>
    @yield('addjs')
</body>

</html>