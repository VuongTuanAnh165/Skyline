<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách bàn ăn</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">Bàn số</th>
                                    <th class="text-center">Số người tối đa</th>
                                    <th class="text-center">Trạng thái</th>
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
                                    <td class="text-center">{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->max_people }}</td>
                                    <th class="text-center {{ ($data->status == 0) ? 'error' : 'success' }}">{{ ($data->status == 0) ? 'Đang trống' : 'Có khách đang dùng' }}</th>
                                    <td class="project-actions text-right">
                                        <a href="javascript:void(0);" data-id="{{$data->id}}" data-toggle="modal" data-target="#modalFormTable" data-url="{{ route('restaurant.table.update', ['branch_id' => $branch->id, 'id' => $data->id]) }}" class="btn btn-info btn-sm btn-modal-form">
                                            <i class="fas fa-pencil-alt"></i>
                                            {{ __('messages.admin.table.edit') }}
                                        </a>
                                        <a class="btn btn-danger btn-sm deleteDialog tip disabledbutton" href="javascript:void(0);" data-id="{{$data->id}} col-6">
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
                                    <th class="text-center">Bàn số</th>
                                    <th class="text-center">Số người tối đa</th>
                                    <th class="text-center">Trạng thái</th>
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