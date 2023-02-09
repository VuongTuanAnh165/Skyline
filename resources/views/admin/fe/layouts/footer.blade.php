<footer class="footer-light">
    <div class="container">
        <div class="row g-custom-x">
            <div class="col-lg-4">
                <a href="index.html">
                    <img src="{{asset('template_web_service/images/logo.png')}}" alt="" />
                    <div class="spacer-20"></div>
                    <p>We are Hostco, a web hosting company with 24/7 customer support. We provide best hosting solutions for your hosting needs. Our clients from personal to corporate. Our data center are all over the world to ensure your website is always up. You can choose shared hosting, vps hosting or cloud hosting. You can also be hosting reseller here. Happy hosting with us.</p>
                </a>
                <div class="spacer-10"></div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="widget">
                            <h5>Dịch vụ</h5>
                            <ul>
                                @foreach($services as $service)
                                <li><a href="#">{{ $service->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="widget">
                            <h5>Khác</h5>
                            <ul>
                                <li><a href="#">Chính sách</a></li>
                                <li><a href="#">Chương trình khuyến mãi</a></li>
                                <li><a href="#">Website</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget">
                    <h5>Chúng tôi chấp nhận thanh toán bằng</h5>
                    <img class="img-card-sm" src="{{ asset('template_web_service/images/payments-logo/visa.png') }}" alt="">
                    <img class="img-card-sm" src="{{ asset('template_web_service/images/payments-logo/master-card.png') }}" alt="">
                    <img class="img-card-sm" src="{{ asset('template_web_service/images/payments-logo/jcb.png') }}" alt="">
                    <img class="img-card-sm" src="{{ asset('template_web_service/images/payments-logo/paypal.png') }}" alt="">
                    <div class="spacer-30"></div>
                    <div class="widget">
                        <h5>Theo dõi chúng tôi tại</h5>
                        <div class="social-icons">
                            <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                            <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                            <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                            <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                            <a href="#"><i class="fa fa-rss fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                            <a href="index.html">
                                Copyright 2022 - Skyline by Vương Tuấn Anh ~ Marvelous
                            </a>
                        </div>
                        <ul class="menu-simple">
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>