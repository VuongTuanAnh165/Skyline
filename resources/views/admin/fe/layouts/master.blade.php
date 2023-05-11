<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>@yield('title')</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Skyline - Dịch vụ cho thuê Acount tốt nhất" name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS Files
    ================================================== -->
    <link href="{{asset('template_web_service/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap"/>
    <link href="{{asset('template_web_service/css/mdb.min.css')}}" rel="stylesheet" type="text/css" id="mdb" />
    <link href="{{asset('template_web_service/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template_web_service/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template_web_service/css/coloring.css')}}" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <link id="colors" href="{{asset('template_web_service/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="{{asset('template_web_service/images/icon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('template_web_service/images/icon.png')}}">
    <link href="{{asset('css/web_service/master.css')}}" rel="stylesheet" type="text/css"/>
    @yield('addcss')
</head>

<body>
    <div id="wrapper">
        
        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        @include('admin.fe.layouts.header')   
        <!-- header close -->
        <!-- content begin -->
        @yield('content')
        <!-- content close -->
        <a href="#" id="back-to-top"></a>
        <!-- footer begin -->
        @include('admin.fe.layouts.footer')
        <!-- footer close -->
        {{-- messenger --}}
        @include('plugin.messenger')
    </div>
    
    <!-- Javascript Files
    ================================================== -->
    <script src="{{asset('template_web_service/js/plugins.js')}}"></script>
    <script src="{{asset('template_web_service/js/designesia.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        function menuToggle() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
        }
    </script>
    @yield('addjs')
</body>

</html>