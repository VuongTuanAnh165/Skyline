<div class="col-md-6">
    <div class="bd-callout bd-callout-danger shadow">
        <h4 class="text-primary">Thứ tự order</h4>
        <b><span>Chọn bàn ăn</span><span class="mdi mdi-arrow-right span-callout"></span><span>Chọn món ăn</span><span class="mdi mdi-arrow-right span-callout"></span><span>Chọn menu món (nếu có)</span><span class="mdi mdi-arrow-right span-callout"></span><span>Xác nhận trạng thái</span><span class="mdi mdi-arrow-right span-callout"></span><span>Thanh toán</span></b>
    </div>
</div>
<div class="col-md-6">
    <div class="bd-callout bd-callout-warning shadow">
        <h4 style="color: #df9a00;">Lưu ý</h4>
        <b class="text-primary">Không thể thay đổi trạng thái khi đơn hàng đã chuẩn bị xong</b><br>
        <b class="text-primary">Sau khi xác nhận trạng thái thì sẽ không thể hủy đơn</b>
    </div>
</div>
<div class="col-md-6 choose-table">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chọn thêm bàn ăn</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-body split-list">
                            <div class="form-group" style="margin: 0;">
                                <h5>Chọn bàn ăn</h5>
                                @php
                                    $choose_table = old('table_id') ? old('table_id') : (isset($order_user_log[0]->table_id) ? $order_user_log[0]->table_id : []);
                                @endphp
                                <select class="form-control select2 table_id" id="table_id" name="table_id[]" multiple>
                                    <option value="">Chọn bàn ăn</option>
                                    @foreach($tables as $table)
                                    <option value="{{ $table->id }}" @if(in_array($table->id, $choose_table)) selected @endif>Bàn số: {{ $table->name }} (Số người tối đa: {{ $table->max_people }})</option>
                                    @endforeach
                                </select>
                                @if ($errors->first('table_id'))
                                <div class="error error-be">{{ $errors->first('table_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button id="btn-add-table" data-url="{{ route('sell.restaurant.eat.addTable') }}" class="btn btn-primary btn-block">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-body split-list">
                            <div class="form-group" style="margin: 0;">
                                <h5>Chọn trạng thái</h5>
                                @php
                                    $choose_status = old('status') ? old('status') : (isset($order_user_log[0]->status) ? $order_user_log[0]->status : []);
                                    $choose_status = '';
                                    $choose_disabled = '';
                                    foreach($order_user_log[0]->status as $item) {
                                        if($item[0] == 7) {
                                            $choose_status = 'checked';
                                            $choose_disabled = 'disabled';
                                            break;
                                        }
                                    }
                                @endphp
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" value=7 {{$choose_status}} {{$choose_disabled}}>
                                    <label style="font-size: 1rem;" class="custom-control-label font-weight-bold text-dark label-status" for="status">{{ $status[7] }}</label>
                                </div>
                                @if ($errors->first('status'))
                                <div class="error error-be">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button disabled id="btn-add-status" data-url="{{ route('sell.restaurant.eat.addStatus') }}" class="btn btn-primary btn-block">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Món ăn</h6>
                </div>
                <div class="card-body p-0">
                    <div class="modal-content-page">
                        <div class="modal-body split-list">
                            <div class="form-group form-dish" style="margin: 0;">
                                <h5>Chọn món ăn</h5>
                                <select class="form-control select2 dish_id" id="dish_id" name="dish_id" multiple>
                                </select>
                                @if ($errors->first('dish_id'))
                                <div class="error error-be">{{ $errors->first('dish_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="row w-100">
                                <div class="col-3 px-0">
                                    <button id="btn-show-dish" data-url="{{ route('sell.restaurant.eat.showDish') }}" class="btn btn-primary btn-block">Lấy món ăn</button>
                                </div>
                                <div class="col-9 pr-0">
                                    <button id="btn-add-dish" data-url="{{ route('sell.restaurant.eat.addDish') }}" class="btn btn-primary btn-block">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 choose-table">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hóa đơn</h6>
        </div>
        <div class="card-body p-0">
            <div class="modal-content-page">
                <div class="modal-header">
                    <input type="hidden" id="order_id" value="{{ $order_user_log[0]->order_id }}">
                    <h5 class="modal-title order-id">ID hóa đơn: {{ $order_user_log[0]->order_id }}</h5>
                </div>
                <div class="modal-body osahan-my-cart">
                    <h5>Bàn ăn:</h5>
                    <ul class="list-table"></ul>
                    <div class="details-page border-top pt-3 osahan-my-cart-item">
                        <h6 class="mb-3">Trạng thái:</h6>
                        <div class="d-flex align-items-center mb-3 list-status">
                            @foreach($order_user_log[0]->status as $item)
                            <div class="ml-4">
                                <p class="mb-0 text-black">{{ $status[$item[0]] }}</p>
                                <p class="mb-0 small">{{ $item[1] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start osahan-my-cart-footer">
                    <div class="row w-100">
                        <div class="col-3 px-0">
                            <button id="btn-delete-order" data-url="{{ route('sell.restaurant.eat.deleteOrder') }}" class="btn btn-warning btn-block">Hủy đơn</button>
                        </div>
                        <div class="col-9 pr-0">
                            <a href="{{ route('sell.restaurant.eat.payment', ['order_id' => $order_user_log[0]->order_id]) }}"><button id="btn-payment-order" disabled class="btn btn-primary btn-block">Thanh toán</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a href="{{ route('sell.restaurant.eat.index') }}" class="btn btn-primary">Trở về</a>
    </div>
</div>
<div class="col-md-12 order-detail">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title" style="margin: 0;">Chi tiết hóa đơn</h4>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-detail">
                <thead class="text-primary">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Món ăn</th>
                        <th class="text-center">Số lượng</th>
                        <th>Lựa chọn (Chú ý món bắt buộc có lựa chọn)</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail_order_log as $item)
                    <tr>
                        <td class="text-center">{{ $item->dish_id }}</td>
                        <td>{{ $item->dish_name }}</td>
                        <td class="text-center"><input type="number" min=1 id="td-quantity" name="td-quantity" value="{{ $item->quantity }}" disabled></td>
                        @php
                            $detail_menu_log_ids = explode(',', $item->detail_menu_log_id);
                            $menu_names = explode(',', $item->menu_name);
                        @endphp
                        <td>
                            @foreach($menu_names as $key => $value)
                            <button class='btn btn-info btn-sm btn-menu'>{{ $value }}</button>
                            @endforeach
                        </td>
                        <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-info btn-sm btn-quantity">
                                <i class="fas fa-pencil-alt"></i>
                                Chỉnh số lượng món
                            </a>
                            <a href="javascript:void(0)" data-id="{{ $item->id }}" data-url="{{ route('sell.restaurant.eat.quantity') }}" class="btn btn-danger btn-sm btn-quantity-save display-none">
                                <span class="mdi mdi-check"></span>
                                Lưu số lượng món ăn
                            </a>
                            <a href="javascript:void(0)" data-detail_order_log_id="{{ $item->id }}" data-url="{{ route('sell.restaurant.eat.showItem') }}" class='btn btn-success btn-sm btn-menu-option' data-toggle="modal" data-target="#MenuItemModal">
                                <i class="fas fa-pencil-alt"></i>
                                Chỉnh option menu
                            </a>
                            <a class="btn btn-danger btn-sm btn-delete-dish" href="javascript:void(0);" data-detail_order_log_id="{{$item->id}}" data-url="{{ route('sell.restaurant.eat.deleteDish') }}">
                                <i class="fas fa-trash"></i>
                                {{ __('messages.admin.table.destroy') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('restaurant.sell.restaurant.eat.modalMenuItem')