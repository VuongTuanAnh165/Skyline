@php
    $src_logo = asset('img/logo_shop.png');
    if ( in_array($name,$arr_route_food) ) {
        $src_logo = asset('img/logo.png');
    }
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{$src_logo}}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/plugins/glightbox.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/vendor/bootstrap.min.css')}}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/web_user/master.css')}}">
    @yield('addcss')
</head>

<body>

    <!-- Start preloader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="L" class="letters-loading">
                        L
                    </span>

                    <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>

                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>

                    <span data-text-preloader="D" class="letters-loading">
                        D
                    </span>

                    <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>

                    <span data-text-preloader="N" class="letters-loading">
                        N
                    </span>

                    <span data-text-preloader="G" class="letters-loading">
                        G
                    </span>
                </div>
            </div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <!-- End preloader -->

    <!-- Start header area -->
    @include('user.layouts.header')
    <!-- End header area -->

    <main class="main__content_wrapper">
        @yield('content')
    </main>

    <!-- Start footer section -->
    @include('user.layouts.footer')
    <!-- End footer section -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>

    <!-- All Script JS Plugins here  -->
    <script src="{{asset('template_web_user/assets/js/vendor/popper.js')}}" defer="defer"></script>
    <script src="{{asset('template_web_user/assets/js/vendor/bootstrap.min.js')}}" defer="defer"></script>
    <script src="{{asset('template_web_user/assets/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('template_web_user/assets/js/plugins/glightbox.min.js')}}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Customscript js -->
    <script src="{{asset('template_web_user/assets/js/script.js')}}"></script>
    @yield('addjs')
    <script>
        $(document).ready(function() {
            function setheight(img) {
                return img.css('height', (img.width() * 132) / 185 + 'px');
            }

            function setheight2(img) {
                return img.css('height', img.width() + 'px');
            }

            function setheight3(img) {
                return img.css('height', (img.width() * 270) / 281 + 'px');
            }

            function setheight4(img) {
                return img.css('height', (img.width() * 9) / 26 + 'px');
            }

            function setheight5(img) {
                return img.css('height', (img.width() * 293) / 370 + 'px');
            }

            function setheight6(img) {
                return img.css('height', (img.width() * 19) / 31 + 'px');
            }
            setheight($('.banner__items--thumbnail__img'));
            setheight2($('.categories2__product--img'));
            setheight3($('.product__items--img'));
            setheight4($('.background-restaurant'));
            setheight5($('.blog__items--img'));
            setheight6($('.related__post--img'));
            $(window).on('resize', function() {
                setheight($('.banner__items--thumbnail__img'));
                setheight2($('.categories2__product--img'));
                setheight3($('.product__items--img'));
                setheight4($('.background-restaurant'));
                setheight5($('.blog__items--img'));
                setheight6($('.related__post--img'));
            });
        })
    </script>
</body>

</html>