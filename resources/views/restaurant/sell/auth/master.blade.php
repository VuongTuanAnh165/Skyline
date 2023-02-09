<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template_web_sell/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template_web_sell/css/osahan.css') }}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{ asset('template_web_sell/font/stylesheet.css') }}" rel="stylesheet">
    <!-- Mdi icons for this template-->
    <link href="{{ asset('template_web_sell/vendor/mdi-icons/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template_web_sell/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/toastr/toastr.min.css') }}">
    <link href="{{ asset('css/web_sell/auth.css') }}" rel="stylesheet">
    @yield('addcss')
</head>

<body id="page-top">
    <div class="row osahan-login m-0">
        <div class="col-md-6 osahan-login-left px-0">
            <img src="{{ asset('img/logo.png') }}">
            <img src="{{ asset('img/logo_shop.png') }}">
        </div>
        @yield('content')
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_web_sell/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template_web_sell/js/osahan.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    @yield('addjs')

</body>

</html>