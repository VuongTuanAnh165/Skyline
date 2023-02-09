<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.policy.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">Dịch vụ</th>
                                    <th>Câu hỏi</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-right">Trả lời</th>
                                    <th class="text-center">Hiện thị ở trang chủ</th>
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
                                    <td class="text-center">{{$data->service_name}}</td>
                                    <td>{{$data->question}}</td>
                                    <th class="text-center {{ ($data->status == 0) ? 'error' : 'success' }}">{{ ($data->status == 0) ? 'Chưa trả lời' : 'Đã trả lời' }}</th>
                                    <th class="text-right">
                                        <button data-id="{{$data->id}}" data-toggle="modal" data-target="#modalHelp" class="btn btn-primary btn-sm btn-show" target="_blank" style="display: -webkit-inline-box;">
                                            <i class="fas fa-receipt"></i>
                                            Xem
                                        </button>
                                    </th>
                                    <td class="text-center">
                                        @php
                                            $choose_show_home = old('show_home') ? old('show_home') : (isset($data->show_home) ? $data->show_home : 0);
                                        @endphp
                                        <a href="{{route('admin.help.updateShowHome', ['id'=>$data->id])}}" class="btn btn-sm {{ $data->show_home == 1 ? 'btn-danger' : 'btn-info' }}">
                                            {{ $data->show_home == 1 ? 'Hide' : 'Show' }}
                                        </a>
                                    </td>
                                    <td class="project-actions text-right">
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
                                    <th class="text-center">Dịch vụ</th>
                                    <th>Câu hỏi</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-right">Trả lời</th>
                                    <th class="text-center">Hiện thị ở trang chủ</th>
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