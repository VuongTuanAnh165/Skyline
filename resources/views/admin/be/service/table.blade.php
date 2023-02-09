<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.service.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.service.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service.table.image') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service_group.title') }}</th>
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
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center"><img style="width: 100px;" src="{{ !empty($data->image) ? asset('storage/'.$data->image) : '' }}"></td>
                                    <td class="text-center">{{ $data->service_group_name }}</td>
                                    <td class="text-center">
                                        @php
                                            $choose_show_home = old('show_home') ? old('show_home') : (isset($data->show_home) ? $data->show_home : 0);
                                        @endphp
                                        <a href="{{route('admin.service.updateShowHome', ['id'=>$data->id])}}" class="btn btn-sm {{ $data->show_home == 1 ? 'btn-danger' : 'btn-info' }}">
                                            {{ $data->show_home == 1 ? 'Hide' : 'Show' }}
                                        </a>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-dark btn-sm show-service" href="{{route('admin.service_type.index', ['id'=>$data->id])}}">
                                            <i class="fas fa-hand-holding-usd"></i>
                                            {{ __('messages.admin.service_type.title') }}
                                        </a>   
                                        <a href="{{route('admin.service.edit', ['id'=>$data->id])}}" class="btn btn-info btn-sm service-update">
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
                                    <th>{{ __('messages.admin.service.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service.table.image') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service_group.title') }}</th>
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
<!-- /.content -->