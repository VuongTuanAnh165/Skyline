<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
        $name = Route::currentRouteName();
        $logo_sidebar = $restaurant ? $restaurant->logo : ($personnel ? $personnel->avatar : '');
        $name_sidebar = $restaurant ? $restaurant->name : ($personnel ? $personnel->name : '');
    @endphp
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ $data_restaurant ? asset('img/logo.png') : asset('img/logo_shop.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sky Line</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/'.$logo_sidebar) }}" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $name_sidebar }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $arg_blog = array(
                        'restaurant.home.index',
                    );
                    $active = '';
                    if ( in_array($name,$arg_blog) ) {
                        $active = 'active';
                    }
                @endphp
                <li class="nav-item">
                    <a href="{{ route('restaurant.home.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('messages.admin.home') }}
                        </p>
                    </a>
                </li>
                @if($restaurant)
                    @include('restaurant.admin.restaurant.aside')
                    @include('restaurant.admin.branch.aside')
                    @include('restaurant.admin.position.aside')
                    @include('restaurant.admin.shift.aside')
                    @include('restaurant.admin.promotion.aside')
                @endif
                @include('restaurant.admin.personnel.aside')
                @include('restaurant.admin.dish.aside')
                @include('restaurant.admin.post.aside')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>