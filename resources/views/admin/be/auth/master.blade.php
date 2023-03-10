<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('template_auth/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template_auth/css/main.css') }}">

    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/toastr/toastr.min.css') }}">
    @yield('addcss')
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{asset('template_web_service/images/logo.png')}}" alt="IMG">
                </div>
                @yield('content')
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('template_auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template_auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('template_auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template_auth/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template_auth/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!-- jquery-validation -->
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    @yield('addjs')

</body>

</html>