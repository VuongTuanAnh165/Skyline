<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
        $name = Route::currentRouteName();
    @endphp
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('template_web_service/images/logo-mobile.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sky Line</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/'.$ceo->avatar) }}" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $ceo->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $arg_blog = array(
                        'ceo.home.index',
                    );
                    $active = '';
                    if ( in_array($name,$arg_blog) ) {
                        $active = 'active';
                    }
                @endphp
                <li class="nav-item">
                    <a href="{{ route('ceo.home.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('messages.admin.home') }}
                        </p>
                    </a>
                </li>
                <li class="nav-header">Dịch vụ</li>
                @include('restaurant.ceo.service.aside')
                @include('restaurant.ceo.help.aside')
                <li class="nav-header">Tài khoản</li>
                @include('restaurant.ceo.order.aside')
                @include('restaurant.ceo.profile.aside')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>