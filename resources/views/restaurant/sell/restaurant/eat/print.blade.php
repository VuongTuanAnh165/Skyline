<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>{{ $restaurant->name }} - Hóa đơn</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template_web_sell/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template_web_sell/css/osahan.css') }}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{ asset('template_web_sell/font/stylesheet.css') }}" rel="stylesheet">
    <!-- Mdi icons for this template-->
    <link href="{{ asset('template_web_sell/vendor/mdi-icons/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template_web_sell/css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/toastr/toastr.min.css') }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/'.$restaurant->logo) }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('storage/'.$restaurant->logo) }}">
    <style>
        body {
            width: 50%;
            margin: auto;
        }

        .display-none {
            display: none;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.4;
        }

        .img-fluid {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .img-logo {
            position: absolute;
            right: 1rem;
            width: auto;
            height: 70px;
            object-fit:contain
        }
    </style>
</head>

<body id="page-top" onclick="printOrder()">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div style="margin: auto;" class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Nhà hàng</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="modal-content-page">
                                        <div style="display: block;" class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">
                                                Tên nhà hàng: {{$restaurant->name}}
                                                <img src="{{ asset('storage/'.$restaurant->logo) }}" class="img-fluid rounded-circle img-logo" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';">
                                            </h5>
                                            <ul class="mb-0 font-weight-bold text-dark">
                                                <li>Số điện thoại: {{ $restaurant->phone }}</li>
                                                <li>Email: {{ $restaurant->email }}</li>
                                            </ul>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="">
                                                    <p class="mb-1 text-danger">Chi nhánh số: {{ $branch->name }}</p>
                                                    <ul class="mb-0 font-weight-bold text-dark">
                                                        <li>Địa chỉ: {{ $branch->address }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông tin hóa đơn</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="modal-content-page">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Mã hóa đơn: {{$data->order_id}}</h5>
                                            <p class="mb-0 font-weight-bold text-dark">Ngày thanh toán: {{ $data->implementation_date }}</p>
                                        </div>
                                        <div class="modal-header">
                                            <p class="mb-0 font-weight-bold text-dark">Thời gian vào: {{ $data->created_at }}</p>
                                            <p class="mb-0 font-weight-bold text-dark">Thời gian ra: {{ $data->updated_at }}</p>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                @php
                                                if($data->update_by == -1) {
                                                $update_by = App\Models\Ceo::find($restaurant->ceo_id);
                                                $position = 'Quản lý';
                                                } else {
                                                $update_by = App\Models\Personnel::leftJoin('positions', 'positions.id', 'personnels.position_id')
                                                ->select('personnels.*', 'positions.name as position_name')
                                                ->where('id', $data->update_by)
                                                ->first();
                                                $position = $update_by->position_name;
                                                }
                                                @endphp
                                                <p class="mb-1 text-danger">Thu ngân:</p>
                                                <a href="javascript:void(0)" class="text-decoration-none d-flex border rounded p-2 bg-light align-items-center mb-2">
                                                    <div class="mr-2"><img src="{{ asset('storage/'.$update_by->avatar) }}" class="img-fluid rounded-circle" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';"></div>
                                                    <div class="ml-2">
                                                        <p class="mb-0 text-dark">{{ $update_by->name }}</p>
                                                        <span class="mb-0 small text-black-50">Chức vụ: {{$position}}</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 border-top">
                                                <div class="">
                                                    <p class="mb-1 text-danger">Bàn:</p>
                                                    <ul class="mb-0 font-weight-bold text-dark">
                                                        @foreach($data->table_id as $value)
                                                        @php
                                                        $tables = App\Models\Table::select('name')->where('id', $value)->first();
                                                        @endphp
                                                        <li>Bàn số: {{ $tables->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="details-page border-top pt-3">
                                                <h6 class="mb-3 text-danger">Chi tiết hóa đơn</h6>
                                                @foreach($data->detail as $value)
                                                @php
                                                $dish = App\Models\Dish::find($value[0]);
                                                @endphp
                                                <div class="d-flex align-items-center">
                                                    <p class="bg-light rounded px-2 mr-3">{{ $value[1] }}</p>
                                                    <p class="text-dark">{{ $dish->name }} ({{ number_format($dish->price) }} VND)</p>
                                                    <p class="ml-auto text-dark font-weight-bold">{{ number_format($value[1] * $dish->price) }} VND</p>
                                                </div>
                                                @if(count($value[2]) > 0)
                                                <ul>
                                                    @foreach($value[2] as $value_item)
                                                    <li>
                                                        @foreach($value_item as $item)
                                                        @php
                                                        $menu = App\Models\Menu::select('name')->where('id', $item[0])->first();
                                                        @endphp
                                                        <div>
                                                            {{$menu->name}}:
                                                            @foreach($item[1] as $value)
                                                            @php
                                                            $menu_item = App\Models\MenuItem::select('name', 'add_price')->where('id', $value)->first();
                                                            @endphp
                                                            @if($menu_item)
                                                            <span>
                                                                <ul>
                                                                    <li>
                                                                        {{ $menu_item->name }}
                                                                        <span style="float:right;" class="font-weight-bold"> + {{ number_format($menu_item->add_price) }} VND</span>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                            @else
                                                            <span>Không có</span>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        @endforeach
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div>
                                                <div class="div_promotion">
                                                    @php
                                                        $promotions = App\Models\Promotion::whereIn('id', $data->promotion_id)->get();
                                                    @endphp
                                                    @foreach($promotions as $promotion)
                                                        <div class="d-flex align-items-center pt-2 border-top">
                                                            <p class="text-dark font-weight-bold m-0">{{ $promotion->name }} - điều kiện: > {{number_format($promotion->condition)}} VND <span>( Trị giá: {{number_format($promotion->value)}} VND )</span></p>
                                                            <p class="ml-auto text-danger m-0 font-weight-bold">- {{ number_format($promotion->value) }} VND</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex align-items-center py-2 border-top">
                                                    <p class="text-dark font-weight-bold m-0">Tổng tiền</p>
                                                    <p id="p_sub_total" class="ml-auto text-danger m-0 font-weight-bold">{{ number_format($data->total_money) }} VND</p>
                                                </div>
                                                <div class="d-flex align-items-center py-2 border-top">
                                                    <p class="text-dark font-weight-bold m-0">Khách trả</p>
                                                    <p id="p_sub_total" class="ml-auto text-danger m-0 font-weight-bold">{{ number_format($data->payment) }} VND</p>
                                                </div>
                                                <div class="d-flex align-items-center py-2 border-top">
                                                    <p class="text-dark font-weight-bold m-0">Tiền thừa</p>
                                                    <p id="p_sub_total" class="ml-auto text-danger m-0 font-weight-bold">{{ $data->payment - $data->total_money > 0 ? number_format($data->payment - $data->total_money) : 0 }} VND</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-start">
                                            <div class="row w-100">
                                                <div class="col-12 pr-0 text-center"><a href="javascript:void(0)" id="a_into_money" class="btn-block">Cảm ơn quý khách, hẹn gặp lại!</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_web_sell/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template_web_sell/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template_web_sell/js/osahan.min.js') }}"></script>
    <script src="{{ asset('template_web_admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        window.addEventListener("load", window.print());

        function printOrder() {
            window.print()
        }
    </script>
</body>

</html>