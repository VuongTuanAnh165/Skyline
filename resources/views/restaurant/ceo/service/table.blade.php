<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bảng danh sách dịch vụ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Chu kỳ thanh toán</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Ngày hết hạn</th>
                                    <th class="text-right">{{ __('messages.admin.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($datas)
                                    @php
                                        $stt = 1;
                                        $nowDate = strtotime(Carbon\Carbon::now());
                                    @endphp
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td class="text-center">{{ $stt }}</td>
                                            <td>
                                                <div style="font-weight: bold;">
                                                    <img class="avatar-personnal" alt=""
                                                        src="{{ asset('storage/' . $data->service_image) }}"
                                                        onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';">
                                                    <span>{{ $data->service_name }}</span>
                                                </div>
                                                <span
                                                    style="font-size: 12px; margin-left: 33px;">{{ $data->email }}</span>
                                            </td>
                                            <td class="text-center">{{ number_format($data->order_ceo_total) }} VND</td>
                                            <td class="text-center">{{ $data->service_charge_month }} tháng</td>
                                            <td
                                                class="text-center {{ $nowDate > strtotime(Carbon\Carbon::parse($data->ended_at)) ? 'error' : 'success' }}">
                                                {{ $nowDate > strtotime(Carbon\Carbon::parse($data->ended_at)) ? 'Đã hết hạn' : 'Đang sử dụng' }}
                                            </td>
                                            <td class="text-center">{{ $data->ended_at }}</td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-success btn-sm modal-rating" style="display: -webkit-inline-box;"
                                                    href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#modalRating"
                                                    data-service_name="{{$data->service_name}}"
                                                    data-email_register="{{$data->email}}"
                                                    data-product_id="{{$data->restaurant_id}}">
                                                    <i class="fas fa-star" style="color: yellow"></i>
                                                    Đánh giá
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $stt++;
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Chu kỳ thanh toán</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Ngày hết hạn</th>
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
