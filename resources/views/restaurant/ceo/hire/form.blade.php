<section class="content content-profile">
    <div class="row">
        <div class="col-md-6">
            <div data-work_type="1" class="card card-primary card-full">
                <div class="card-header">
                    <h3 class="card-title">Email đăng ký</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email-service">Nhập email</label>
                                <input type="email" name="email_service" id="email_service" value="" placeholder="Nhập email" class="form-control email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="check-email btn btn-primary">Check email</button>
                            <button class="under-email display-none btn btn-warning">Đổi email</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div data-work_type="0" class="card card-secondary card-part">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khách hàng</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row profile-ceo">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên khách hàng</label>
                                        <input type="name" disabled id="name" name="name" value="{{ $ceo->name }}" placeholder="Nhập tên khách hàng" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email khách hàng</label>
                                        <input type="email" disabled id="email" name="email" value="{{ $ceo->email }}" placeholder="Nhập email khách hàng" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại khách hàng</label>
                                        <input type="text" disabled id="phone" name="phone" value="{{ $ceo->phone }}" placeholder="Nhập số điện thoại khách hàng" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cmnd">CMND khách hàng</label>
                                        <input type="text" disabled id="cmnd" name="cmnd" value="{{ $ceo->cmnd }}" placeholder="Nhập cmnd khách hàng" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-avatar float-right">
                                <label for="avatar" class="control-label">Avatar</label>
                                <div class="upload-avatar">
                                    <input disabled class="up-avatar" accept="image/*" type="file" id="imgInp" name="avatar" data-msg-accept="{{ __('validation.form.image') }}" />
                                    <img id="blah" src="{{ isset($ceo) ? asset('storage/'.$ceo->avatar) : '' }}" class="avatar-personnel" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';">
                                </div>
                                @if ($errors->first('avatar'))
                                <div class="error error-commit">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input disabled type="text" id="address" name="address" value="{{ $ceo->address }}" placeholder="Nhập address khách hàng" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="edit-profile btn btn-primary">Sửa thông tin</button>
                            <button class="save-profile display-none btn btn-success">Lưu</button>
                            <button class="reset-profile display-none btn btn-warning">Đặt Lại</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-12 text-center">
            <button class="continue btn btn-lg btn-block btn-success display-none">Tiếp tục</button>
        </div>
    </div>
</section>
<section class="content content-order display-none">
    @php
    $nowDate = Carbon\Carbon::now();
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-danger" style="color: red;">
                    <h5><i class="fas fa-info"></i> Lưu ý:</h5>
                    Hãy điền đúng địa chỉ email của bạn. Bởi vì chúng tôi sẽ cung cấp password gửi đến email của bạn.
                </div>


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
                            @php
                            $str = str_replace('-', '', $nowDate->toDateTimeString());
                            $str = str_replace(':', '', $str);
                            $str = str_replace(' ', '', $str);
                            $order_id = Illuminate\Support\Str::random(5) . '_' . $str;
                            @endphp
                            <b>Hóa đơn</b><br>
                            <br>
                            <b>ID:</b> <span class="order-id">{{$order_id}}</span><br>
                            <input type="hidden" id="order_id" value="{{$order_id}}">
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
                                        <td class="table-check-email"></td>
                                        <td>{{number_format($service_charge->price)}} VND</td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" id="service_charge_id" name="service_charge_id" value="{{$service_charge->id}}">
                            <input type="hidden" id="implementation_date" name="implementation_date" value="{{$nowDate->toDateString()}}">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Phương thức thanh toán:</p>
                            <div id="paypal-button-container"></div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Hóa đơn ngày: {{$nowDate->toDateString()}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Tổng phụ:</th>
                                        <td>{{number_format($service_charge->price)}} VND</td>
                                    </tr>

                                    <tr>
                                        <th>Khuyến mại:</th>
                                        <td>
                                            <select class="form-control select2 promotion_id" multiple id="promotion_id" name="promotion_id">
                                                <option value=""></option>
                                                @if($promotions && count($promotions) > 0)
                                                @foreach($promotions as $promotion)
                                                <option value="{{$promotion->id}}">{{$promotion->name}} (Giảm {{$promotion->value}} %)</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Thành tiền:</th>
                                        <td class="total">{{number_format($service_charge->price)}} VND</td>
                                        <input type="hidden" id="subtotal" name="subtotal" value="{{$service_charge->price}}">
                                        <input type="hidden" id="total" name="total" value="{{$service_charge->price}}">
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <!-- <div class="row no-print">
                        <div class="col-12">
                            <a href="{{route('ceo.hire.print')}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div> -->
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
            <div class="col-md-12 text-center">
                <button class="back btn btn-lg btn-block btn-success">Trở lại</button>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->