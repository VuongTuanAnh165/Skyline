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

    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/'.$restaurant->logo) }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('storage/'.$restaurant->logo) }}">
    @yield('addcss')
    <style>
        .display-none {
            display: none;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.4;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('restaurant.sell.layouts.aside')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="margin-top: 70px">
                <!-- Topbar -->
                @include('restaurant.sell.layouts.header')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('restaurant.sell.layouts.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_web_sell/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template_web_sell/js/osahan.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    @yield('addjs')

</body>

</html>