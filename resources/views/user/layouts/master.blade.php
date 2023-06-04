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
    
    <meta name="description" content="Sky Line là nền tảng quản lý và bán hàng đa kênh được sử dụng nhiều nhất Việt Nam với hơn 190,000 khách hàng. Giúp bạn bán hàng từ online đến cửa hàng và quản lý tập trung.">
    <meta name="keywords" content="Sky Line, Marvelous, Dịch vụ, Nhà hàng, Shop, Bán hàng, Thương Mại điện tử">
    <meta name="author" content="Sky Line" />
    <link rel="canonical" href="http://skylinevta.click/"/>
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://skylinevta.click/">
    <meta property="og:title" content="Sky Line">
    <meta property="og:description" content="Sky Line là nền tảng quản lý và bán hàng đa kênh được sử dụng nhiều nhất Việt Nam với hơn 190,000 khách hàng. Giúp bạn bán hàng từ online đến cửa hàng và quản lý tập trung.">
    <meta property="og:image" content="{{$src_logo}}">
    <meta property="og:image:alt" content="Sky Line">
    
    <!--Open Graph / Twitter -->
    <meta name="twitter:card" content="summary">
    <meta property="twitter:type" content="summary_large_image">
    <meta property="twitter:url" content="http://skylinevta.click/">
    <meta property="twitter:title" content="Sky Line">
    <meta property="twitter:description" content="Sky Line là nền tảng quản lý và bán hàng đa kênh được sử dụng nhiều nhất Việt Nam với hơn 190,000 khách hàng. Giúp bạn bán hàng từ online đến cửa hàng và quản lý tập trung.">
    <meta property="twitter:image" content="{{$src_logo}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$src_logo}}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/plugins/glightbox.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/toastr/toastr.min.css') }}">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{asset('template_web_user/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/web_user/master.css')}}">
    @yield('addcss')
    <style>
        .error {
            margin: -1.5rem 0 1.5rem;
            color: red;
        }

        .user-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .sub-menu-acount {
            padding: 10px;
            width: max-content;
        }

        .header__account--items:hover .sub-menu-acount {
            margin-top: 10px;
        }
    </style>
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
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
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

            $(document).on('click', '.btn-account', function() {
                redirectUser();
            })

            $('.minicart__open--btn').on('click', function() {
                let service_id = $('#service_id_check').val();
                $.ajax({
                    url: `{{route('user.showCart')}}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        service_id: service_id,
                    },
                    cache: false,
                    method: 'POST',
                    success: function(response) {
                        if (response.code == 200) {
                            console.log(response.data);
                            let html = ``;
                            for (let x in response.data) {
                                let route = `{{ route($url_product, ['id' => 'param_id', 'name_link' => 'param_name_link', 'code' => 'param_code']) }}`;
                                route = route.replace('param_id', response.data[x].dish_id);
                                route = route.replace('param_name_link', response.data[x].name_link);
                                route = route.replace('param_code', response.data[x].id);
                                let src_img = '';
                                if (!response.data[x].image && response.data[x].image.length) {
                                    src_img = `{{asset('storage/src_img')}}`;
                                    src_img = src_img.replace(src_img, response.data[x].image);
                                } else {
                                    src_img = `{{ asset('img/background_default.jpg') }}`
                                }
                                html += `
                                    <div class="minicart__product--items d-flex">
                                        <div class="minicart__thumb">
                                            <a href="`+route+`"><img src="${src_img}" alt="prduct-img"></a>
                                        </div>
                                        <div class="minicart__text">
                                            <h4 class="minicart__subtitle"><a href="`+route+`">${response.data[x].name}.</a></h4>
                                            <div class="minicart__text--footer d-flex align-items-center">
                                                <div class="quantity__box minicart__quantity">
                                                    <div class="quantity__number">Số lượng: ${response.data[x].quantity}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `
                            }
                            $('.minicart__header--desc_span').text(response.data.length)
                            $('.minicart__product').html(html);
                        }
                    },
                    error: function(xhr) {}
                });
            });
        })
    </script>
    @yield('addjs')
</body>

</html>