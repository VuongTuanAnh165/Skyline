<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm osahan-nav-top"
    style="position: fixed; z-index: 1; top: 0; width: -webkit-fill-available;">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Nav Item - deals -->
        <li class="nav-item dropdown no-arrow mx-2 osahan-t-bd">
            <a class="nav-link dropdown-toggle text-dark" data-toggle="modal" data-target="#mycoupansModal" href="#">
                <i class="mdi mdi-food text-warning"></i><span class="ml-2">{{ $restaurant->name }}</span>
            </a>
        </li>
        <!-- Nav Item - location -->
        <li class="nav-item dropdown no-arrow mx-2 osahan-t-loc">
            <a class="nav-link dropdown-toggle text-dark" href="#" data-toggle="modal" data-target="#addressModal">
                <span class="mdi mdi-crosshairs-gps"></span><span class="ml-2">{{ $branch->address }}</span>
            </a>
        </li>
        <!-- Nav Item - pickup -->
        <li class="nav-item dropdown no-arrow mx-2 osahan-t-pu">
            <a class="nav-link dropdown-toggle text-dark" href="orders.html">
                <i class="mdi mdi-source-branch text-danger"></i><span class="ml-2">Chi nhánh số: {{ $branch->name }}</span>
            </a>
        </li>
    </ul>
    <!-- Topbar Search -->
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('change-branch-form').submit();">Đổi chi nhánh</a>
        <form id="change-branch-form" action="{{ route('sell.post.changeBranch') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="javascript:void(0)" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Đăng xuất
        </a>
        <form id="logout-form" action="{{ route('sell.post.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
@section('addjs')
    <script>
        $(document).ready(function() {
            $('.btn-logout').on('click', function() {
                $.ajax({
                    url: `{{ route('sell.post.logout') }}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                    },
                    error: function(xhr) {

                    }
                })
            });
        })
    </script>
@stop