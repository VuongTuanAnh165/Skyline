<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sky Line | Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template_web_admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template_web_admin/dist/css/adminlte.min.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('template_web_service/images/icon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('template_web_service/images/icon.png')}}">
</head>

<body onclick="printOrder()">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content content-order display-none">
            @php
            $nowDate = Carbon\Carbon::now();
            @endphp
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img src="{{asset('template_web_service/images/logo.png')}}" alt="Logo" class="brand-image" width="200px">
                                        <small class="float-right">Ngày: {{$nowDate->toDateString()}}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Admin, {{$skyline->name}}.</strong><br>
                                        Địa chỉ: {{$skyline->address}}<br>
                                        SĐT: {{$skyline->phone}}<br>
                                        Email: {{$skyline->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong><span class="span-ceo-name">{{ $ceo->name }}</span></strong><br>
                                        Địa chỉ: <span class="span-ceo-address">{{ $ceo->address }}</span><br>
                                        SĐT: <span class="span-ceo-phone">{{ $ceo->phone }}</span><br>
                                        Email: <span class="span-ceo-email">{{ $ceo->email }}</span>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Hóa đơn</b><br>
                                    <br>
                                    <b>ID:</b> <span class="order-id">{{$order->order_id}}</span><br>
                                    <b>Ngày thanh toán:</b> <span class="order-id">{{$order->implementation_date}}</span><br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID dịch vụ</th>
                                                <th>Tên dịch vụ</th>
                                                <th>Loại</th>
                                                <th>Thời hạn</th>
                                                <th>Mô tả</th>
                                                <th>Email đăng nhập</th>
                                                <th>Password</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$service->id}}</td>
                                                <td>{{$service->name}}</td>
                                                <td>{{$service_type->name}}</td>
                                                <td>{{$service_charge->month}} tháng</td>
                                                <td>{!! $service->content !!}</td>
                                                <td class="table-check-email">{{ $restaurant->email }}</td>
                                                <td>{{$order->password}}</td>
                                                <td>{{number_format($service_charge->price)}} VND</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Phương thức thanh toán:</p>
                                    <img style="width:80%" src="{{ asset('img/PayPal-PNG-Download-Image.png') }}">
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Hóa đơn ngày: {{ $order->created_at}}</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Tổng phụ:</th>
                                                <td>{{number_format($order->subtotal)}} VND</td>
                                            </tr>

                                            <tr>
                                                <th>Khuyến mại:</th>
                                                <td>
                                                    @if($promotions && count($promotions) > 0)
                                                    @foreach($promotions as $promotion)
                                                    <p>{{$promotion->name}} (Giảm {{$promotion->value}} %)</p>
                                                    @endforeach
                                                    @else
                                                    <p>Không có</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Thành tiền:</th>
                                                <td class="total">{{number_format($order->total)}} VND</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
        function printOrder() {
            window.print()
        }
    </script>
</body>

</html>