<section class="restaurant-header shadow">
    <div class="container">
        <div class="mb-4">
            <div class="card-body p-0">
                <div class="modal-content-page">
                    <div class="modal-body split-list">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <img src="{{asset('storage/'.$restaurant->background[0])}}" class="background-restaurant">
                                <div class="profile-restaurant">
                                    <a href="#" class="text-decoration-none d-flex rounded p-2 align-items-center mb-2">
                                        <div class="mr-4"><img src="{{asset('storage/'.$restaurant->logo)}}" class="img-fluid rounded-circle" width="100px"></div>
                                        <div class="">
                                            <p class="mb-4 current__price name-restaurant">{{ $restaurant->name }}</p>
                                            <p class="mb-0 small text-black-50">{{ $restaurant->email }}</p>
                                        </div>
                                    </a>
                                    <button class="button-17 product__banner2--content__btn text-white">Theo dõi</button>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12 mo-ta">
                                <ul>
                                    <li class="m-0 font-weight-bold text-dark">Đánh giá: <span style="color:red; margin-left:1rem">314</span></li>
                                    <li class="m-0 font-weight-bold text-dark">Tỉ lệ phản hồi: <span style="color:red; margin-left:1rem">90%</span></li>
                                    <li class="m-0 font-weight-bold text-dark">Thời gian phản hổi: <span style="color:red; margin-left:1rem">trong vài giờ</span></li>
                                </ul>
                                <ul>
                                    <li class="m-0 font-weight-bold text-dark">Người theo dõi: <span style="color:red; margin-left:1rem">314</span></li>
                                    <li class="m-0 font-weight-bold text-dark">Sản phẩm: <span style="color:red; margin-left:1rem">1</span></li>
                                    <li class="m-0 font-weight-bold text-dark">Tham gia: <span style="color:red; margin-left:1rem">2023-01-31</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>