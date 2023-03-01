<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.category.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.category.table.name') }}</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">{{ __('messages.admin.dish.table.image') }}</th>
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
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->service_name }}</td>
                                    <td class="text-center"><img style="width: 100px;" src="{{ !empty($data->image) ? asset('storage/'.$data->image) : '' }}"></td>
                                    <td class="project-actions text-right">
                                        <div data-id="{{$data->id}}" data-toggle="modal" data-target="#modalFormCategory" data-url="{{ route('admin.category.update', ['id' => $data->id]) }}" class="btn btn-info btn-sm dish-update btn-modal-form">
                                            <i class="fas fa-pencil-alt"></i>
                                            {{ __('messages.admin.table.edit') }}
                                        </div>
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
                                    <th>{{ __('messages.admin.category.table.name') }}</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center">{{ __('messages.admin.dish.table.image') }}</th>
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