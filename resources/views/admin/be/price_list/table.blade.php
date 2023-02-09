<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bảng danh sách lựa chọn bảng giá</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="">Tên</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">Loại dịch vụ</th>
                                    <th class="text-center">Loại lựa chọn</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-right">{{ __('messages.admin.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                @php
                                $stt = 1;
                                @endphp
                                @foreach($datas as $data)
                                <tr>
                                    <td class="text-center">{{$stt}}</td>
                                    <td class="">{{$types[$data->name]}}</td>
                                    <td>{{$data->service_name}}</td>
                                    <th class="text-center">{{ ($data->type_service == 1) ? 'Quản lý dành cho nhà hàng/shop' : 'Quản lý dành cho bán hàng' }}</th>
                                    <th class="text-center">{{ ($data->type_list == 1) ? 'Text' : 'Boolean' }}</th>
                                    <td class="text-center">{{ ($data->model > -1 ) ? $models[$data->model] : '' }}</td>
                                    <td class="project-actions text-right">
                                        <a href="{{route('admin.price_list.edit', ['id'=>$data->id])}}" class="btn btn-info btn-sm price_list-update">
                                            <i class="fas fa-pencil-alt"></i>
                                            {{ __('messages.admin.table.edit') }}
                                        </a>
                                        <a class="btn btn-danger btn-sm deleteDialog tip" href="javascript:void(0);" data-id="{{$data->id}}">
                                            <i class="fas fa-trash"></i>
                                            {{ __('messages.admin.table.destroy') }}
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
                                    <th class="">Tên</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">Loại dịch vụ</th>
                                    <th class="text-right">Loại lựa chọn</th>
                                    <th class="text-center">Model</th>
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
<div class="modal fade" id="modalHelp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Câu trả lời</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" class="help-id">
                <div class="form-group">
                    <label for="question">Câu hỏi: </label>
                    <div class="modal-question"></div>
                </div>
                <div class="form-group">
                    <label for="answer">Câu trả lời: </label>
                    <textarea rows="8" id="answer" class="modal-answer form-control"></textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary btn-sm save-answer" target="_blank" style="display: -webkit-inline-box;">
                        Lưu
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->