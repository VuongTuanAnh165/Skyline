<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.branch.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.branch.table.name') }}</th>
                                    <th>{{ __('messages.admin.branch.table.address') }}</th>
                                    <th>{{ __('messages.admin.branch.table.open_time') }}</th>
                                    <th>{{ __('messages.admin.branch.table.close_time') }}</th>
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
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->open_time }}</td>
                                    <td>{{ $data->close_time }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-warning btn-sm" href="{{ route('restaurant.table.index', ['id' => $data->id]) }}">
                                            <i class="fas fa-table"></i>
                                            Bàn ăn
                                        </a> 
                                        <a class="btn btn-primary btn-sm" href="{{ route('restaurant.branch.show', ['id' => $data->id]) }}">
                                            <i class="fas fa-folder"></i>
                                            {{ __('messages.admin.table.show') }}
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
                                    <th>{{ __('messages.admin.branch.table.name') }}</th>
                                    <th>{{ __('messages.admin.branch.table.address') }}</th>
                                    <th>{{ __('messages.admin.branch.table.open_time') }}</th>
                                    <th>{{ __('messages.admin.branch.table.close_time') }}</th>
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