<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bảng danh sách hóa đơn</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">ID hóa đơn</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Ngày cần thanh toán</th>
                                    <th class="text-center">Tổng cộng</th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-right">{{ __('messages.admin.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                @php
                                    $stt = 1;
                                    $nowDate = strtotime(Carbon\Carbon::now());
                                @endphp
                                @foreach($datas as $data)
                                <tr>
                                    <td class="text-center">{{$stt}}</td>
                                    <td class="text-center">{{ $data->order_id }}</td>
                                    <td class="text-center">{{ $data->created_at }}</td>
                                    <td class="text-center">{{ $data->implementation_date }}</td>
                                    <td class="text-center">{{ number_format($data->total) }} VND</td>
                                    <td class="text-center">{{ $data->type == 1 ? 'Thuê mới' : 'Gia hạn' }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" target="_blank" style="display: -webkit-inline-box;" href="{{ route('ceo.order.print', ['id' => $data->id]) }}">
                                            <i class="fas fa-receipt"></i>
                                            Xem hóa đơn
                                        </a>                           
                                    </td>
                                </tr>
                                @php
                                    $stt ++;
                                @endphp
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">ID hóa đơn</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Ngày cần thanh toán</th>
                                    <th class="text-center">Tổng cộng</th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-right">{{ __('messages.admin.table.action') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->