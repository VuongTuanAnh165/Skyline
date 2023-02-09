@extends('restaurant.sell.layouts.master')
@section('title', __('messages.admin.home') )
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3 mt-2">
        <h5 class="mb-0">Explore categories</h5>
        <a href="listing.html" class="small font-weight-bold text-dark">See all <i class="mdi mdi-chevron-right mr-2"></i></a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Popular -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-fire bg-danger text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">Popular</h6>
                <p class="mb-0 small">286+ options</p>
            </div>
        </a>
        <!-- fast delivery -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-motorbike bg-primary text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">Fast Delivery</h6>
                <p class="mb-0 small">1,843+ options</p>
            </div>
        </a>
        <!-- high class -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-wallet-outline bg-warning text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">High class</h6>
                <p class="mb-0 small">25+ options</p>
            </div>
        </a>
        <!-- Dine in -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-silverware-variant bg-danger text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">Dine in</h6>
                <p class="mb-0 small">182+ options</p>
            </div>
        </a>
        <!-- Pick up -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-home-variant-outline bg-primary text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">Pick up</h6>
                <p class="mb-0 small">3,548+ options</p>
            </div>
        </a>
        <!-- Nearest -->
        <a href="listing.html" class="text-decoration-none col-xl-2 col-md-4 mb-4">
            <div class="rounded py-4 bg-white shadow-sm text-center">
                <i class="mdi mdi-map-outline bg-warning text-white osahan-icon mx-auto rounded-pill"></i>
                <h6 class="mb-1 mt-3">Nearest</h6>
                <p class="mb-0 small">44+ options</p>
            </div>
        </a>
    </div>
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3 mt-2">
        <h5 class="mb-0">Featured restaurants</h5>
        <a href="listing.html" class="small font-weight-bold text-dark">See all <i class="mdi mdi-chevron-right mr-2"></i></a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Featured restaurants -->
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/burgerking.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">Burger King</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.8</span> (873)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Burger
                        <i class="mdi mdi-currency-inr ml-3"></i> 340/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-light"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 0.3 km</span>
                    </p>
                </div>
            </div>
        </a>
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/pizzahut.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">Pizza Hut</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.5</span> (34)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Pizza
                        <i class="mdi mdi-currency-inr ml-3"></i> 150/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-info"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 15 MIN</span>
                    </p>
                </div>
            </div>
        </a>
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/kfc.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">KFC</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.8</span> (873)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Burger
                        <i class="mdi mdi-currency-inr ml-3"></i> 340/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-primary"><i class="mdi mdi-wallet-outline"></i> Cashback</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 0.3 km</span>
                    </p>
                </div>
            </div>
        </a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Featured restaurants -->
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/macd.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">Mac Donalds</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.5</span> (223)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Fires
                        <i class="mdi mdi-currency-inr ml-3"></i> 220/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-light"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 30 MIN</span>
                    </p>
                </div>
            </div>
        </a>
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/domino.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">Dominos</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.8</span> (873)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Pizza
                        <i class="mdi mdi-currency-inr ml-3"></i> 340/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-light"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 0.3 km</span>
                    </p>
                </div>
            </div>
        </a>
        <a href="detail.html" class="text-dark text-decoration-none col-xl-4 col-lg-12 col-md-12">
            <div class="bg-white shadow-sm rounded d-flex align-items-center p-1 mb-4 osahan-list">
                <div class="bg-light p-3 rounded">
                    <img src="img/subway.png" class="img-fluid">
                </div>
                <div class="mx-3 py-2 w-100">
                    <p class="mb-2 text-black">Subway</p>
                    <p class="small mb-2">
                        <i class="mdi mdi-star text-warning mr-1"></i> <span class="font-weight-bold text-dark">0.8</span> (200)
                        <i class="mdi mdi-silverware-fork-knife ml-3 mr-1"></i> Sub's
                        <i class="mdi mdi-currency-inr ml-3"></i> 400/-
                    </p>
                    <p class="mb-0 text-muted d-flex align-items-center"><span class="badge badge-success"><i class="mdi mdi-ticket-percent-outline"></i> 55% OFF</span>
                        <span class="small ml-auto"><i class="mdi mdi-map-marker"></i> 35 Min</span>
                    </p>
                </div>
            </div>
        </a>
    </div>
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3 mt-2">
        <h5 class="mb-0">Asian food</h5>
        <a href="listing.html" class="small font-weight-bold text-dark">See all <i class="mdi mdi-chevron-right mr-2"></i></a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Asian list -->
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food1.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Spicy Na Thai Pizza</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food2.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Special Burger</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food3.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Tandoori</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Asian list -->
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food4.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Special Thali</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food5.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Diet Food</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-xl-4 col-md-4 mb-4" data-toggle="modal" data-target="#myitemsModal">
            <img src="img/food6.jpg" class="img-fluid rounded">
            <div class="d-flex align-items-center mt-3">
                <p class="text-black h6 m-0">Sandwich</p>
                <span class="badge badge-light ml-auto"><i class="mdi mdi-truck-fast-outline"></i> Free delivery</span>
            </div>
        </a>
    </div>
</div>
@stop