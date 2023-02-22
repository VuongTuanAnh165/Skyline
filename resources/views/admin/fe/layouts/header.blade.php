<header class="header-light transparent has-topbar">
    @php
    $name_route = Route::currentRouteName();
    @endphp
    <div id="topbar">
        <div class="container">
            <div class="topbar-left xs-hide">
                <span class="topbar-widget">
                    <a href="#">Sky line!</a>
                </span>
            </div>

            <div class="topbar-right">
                <div class="topbar-widget"><a href="#"><i class="fa fa-phone"></i>{{ $skyline->phone }}</a></div>
                <div class="topbar-widget"><a href="#"><i class="fa fa-envelope"></i>{{ $skyline->email }}</a></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{ route('admin.fe.home.index') }}">
                                    <img class="logo-main" src="{{asset('template_web_service/images/logo.png')}}" alt="" />
                                    <img class="logo-mobile" src="{{asset('template_web_service/images/logo-mobile.png')}}" alt="" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            @php
                                $arg_home = array(
                                    'admin.fe.home.index',
                                );
                                $active = '';
                                if ( in_array($name_route,$arg_home) ) {
                                    $active = 'active';
                                }
                            @endphp
                            <li><a class="menu-item {{$active}}" href="{{route('admin.fe.home.index')}}">Trang chủ</a></li>
                            @php
                                $arg_home = array(
                                    'admin.fe.service.index',
                                );
                                $active = '';
                                if ( in_array($name_route,$arg_home) ) {
                                    $active = 'active';
                                }
                            @endphp
                            @foreach($service_groups as $service_group)
                            <li><a class="menu-item {{$active}}" href="javascript:void(0)">{{ $service_group->name }}</a>
                                <ul class="mega">
                                    <li>
                                        <div class="container">
                                            <div class="sb-menu p-4 pb-0">
                                                <div class="row g-custom-x">
                                                    <div class="col-lg-4 mb-sm-30">
                                                        <h4>Dịch vụ {{ $service_group->name }}</h4>
                                                        <p style="margin-bottom: 20px;">{{ $service_group->description }}</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            @php
                                                                $services = \App\Models\Service::select('id', 'name', 'image', 'name_link')->where('service_group_id', $service_group->id)->get();
                                                            @endphp
                                                            @foreach($services as $service)
                                                            <div class="col-lg-6">
                                                                <a class="box-icon mb20" href="{{route('admin.fe.service.index', ['id' => $service->id, 'name_link' => $service->name_link])}}">
                                                                    <img src="{{asset('storage/'.$service->image)}}" alt="">
                                                                    <div class="d-inner">
                                                                        <h4>{{ $service->name }}</h4>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @endforeach
                            @php
                                $arg_home = array(
                                    'admin.fe.policy.index',
                                );
                                $active = '';
                                if ( in_array($name_route,$arg_home) ) {
                                    $active = 'active';
                                }
                            @endphp
                            <li><a class="menu-item {{$active}}" href="javascript:void(0)">Chính sách</a>
                                <ul>
                                    @foreach($policys as $policy)
                                    <li><a class="menu-item" href="{{route('admin.fe.policy.index', ['id' => $policy->id, 'name_link' => $policy->name_link])}}">{{$policy->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a class="menu-item" href="javascript:void(0)">Chương trình khuyễn mãi</a>
                                <ul>
                                    @foreach($promotions as $promotion)
                                    <li><a class="menu-item" href="contact.html">{{$promotion->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a class="menu-item" href="#">Website</a>
                        </ul>
                    </div>
                    <div class="de-flex-col">
                        <div class="action">
                            <div class="profile" onclick="menuToggle();">
                                <img src="{{ isset($ceo) ? asset('storage/'.$ceo->avatar) : asset('img/avatar_default.png') }}">
                            </div>
                            <div class="menu">
                                @if(isset($ceo))
                                <h3>{{ $ceo->name }}<br /><span>{{ $ceo->email }}</span></h3>
                                @else
                                <h3>Sky line<br /><span>Cung cấp dịch vụ tốt nhất</span></h3>
                                @endif
                                <ul style="padding: 0;">
                                    @if(isset($ceo))
                                    <li>
                                        <img src="{{asset('img/settings.png')}}" /><a href="{{ route('ceo.home.index') }}">Trang quản trị</a>
                                    </li>
                                    <li>
                                        <img src="{{asset('img/log-out.png')}}" />
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                            <form id="logout-form" action="{{ route('admin.fe.post.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                    @else
                                    @php
                                        $arg_home = array(
                                            'admin.fe.login',
                                        );
                                        $active = '';
                                        if ( in_array($name_route,$arg_home) ) {
                                            $active = 'active-auth';
                                        }
                                    @endphp
                                    <li class="{{$active}}">
                                        <img src="{{asset('img/log-in.png')}}" /><a href="{{ route('admin.fe.login') }}">Đăng nhập</a>
                                    </li>
                                    @php
                                        $arg_home = array(
                                            'admin.fe.register',
                                        );
                                        $active = '';
                                        if ( in_array($name_route,$arg_home) ) {
                                            $active = 'active-auth';
                                        }
                                    @endphp
                                    <li class="{{$active}}">
                                        <img src="{{asset('img/user.png')}}" /><a href="{{ route('admin.fe.register') }}">Đăng ký</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <span id="menu-btn"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>