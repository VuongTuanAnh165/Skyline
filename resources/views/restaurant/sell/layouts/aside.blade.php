<!-- Sidebar -->
@php
    $name = Route::currentRouteName();
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="padding-top: 70px;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="{{ route('sell.home.index') }}" 
        style="position: fixed; width: inherit; top: 0; background-color: #c60021;">
        <div style="display: flex; justify-content:space-between" class="sidebar-brand-icon">
            <img src="{{ asset('storage/'.$restaurant->logo) }}" class="img-fluid">
        </div>
    </a>
    <!-- Nav Item - Home -->
    @php
        $arg_blog = array(
            'sell.home.index',
        );
        $active = '';
        if ( in_array($name,$arg_blog) ) {
            $active = 'active';
        }
    @endphp
    <li class="nav-item {{ $active }}">
        <a class="nav-link" href="{{ route('sell.home.index') }}">
            <i class="mdi mdi-home-variant-outline"></i>
            <span>Trang chủ</span></a>
    </li>
    @include('restaurant.sell.restaurant.eat.aside')
    <!-- Nav Item - Favourities -->
    <li class="nav-item">
        <a class="nav-link" href="favourities.html">
            <i class="mdi mdi-bookmark-outline"></i>
            <span>Favourities</span></a>
    </li>
    <!-- Nav Item - Orders -->
    <li class="nav-item">
        <a class="nav-link" href="orders.html">
            <i class="mdi mdi-book-open"></i>
            <span>Orders</span></a>
    </li>
    <!-- Nav Item - Messages -->
    <li class="nav-item">
        <a class="nav-link d-flex" href="messages.html">
            <i class="mdi mdi-message-text-outline mr-2"></i>
            <span>Messages</span>
            <span class="rounded-circle bg-white text-primary ml-auto px-2 py-1">2</span></a>
    </li>
    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link" href="settings.html">
            <i class="mdi mdi-cog"></i>
            <span>Settings</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Extra Pages</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pages:</h6>
                <a class="collapse-item" href="detail.html">Details</a>
                <a class="collapse-item" href="listing.html">Listing</a>
                <a class="collapse-item" href="messages.html">Messages</a>
                <a class="collapse-item" href="search.html">Search</a>
                <a class="collapse-item" href="buttons.html">Components</a>
                <a class="collapse-item" href="404.html">Page Not Found</a>
                <h6 class="collapse-header">Account:</h6>
                <a class="collapse-item" href="signin.html">Signin</a>
                <a class="collapse-item" href="signup.html">Signup</a>
                <a class="collapse-item" href="forgot.html">Forgot Password</a>
            </div>
        </div>
    </li>
    <!-- offers -->
    <div class="bg-white m-3 p-3 sidebar-alert rounded text-center alert fade show d-none d-md-inline" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="mdi mdi-food mb-3"></i>
        <p class="text-black mb-1">Free delivery on<br>all orders over <span class="text-primary">$25</span></p>
        <p class="small">It is a limited time offer that will expire soon.</p>
        <a href="explore.html" class="btn btn-primary btn-block btn-sm">Order now <i class="pl-3 fas fa-long-arrow-alt-right"></i></a>
    </div>
    <!-- User -->
    <div class="d-none d-md-block">
        <div class="user d-flex align-items-center p-3">
            <div class="pr-3" style="width: 30%;">
                <img style="width: 100%; border-radius: 50%;" src="{{ asset('storage/'.$account->avatar) }}">
            </div>
            <div style="width: 70%">
                <p class="mb-0 text-white">{{ $account->name }}</p>
                <p class="mb-0 text-white-50 small">{{ $account->email }}</p>
            </div>
        </div>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->