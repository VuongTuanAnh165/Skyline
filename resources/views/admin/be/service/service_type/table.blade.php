<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.service_type.table.title') . ': ' . $service->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.service_type.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service.table.service_charge') }}</th>
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
                                    @php
                                        $service_charges = \App\Models\ServiceCharge::where('service_type_id', $data->id)->get();
                                    @endphp
                                    <td class="text-center">
                                        @if($service_charges && count($service_charges) > 0)
                                            @foreach($service_charges as $item)
                                                {{ $item->month . ' tháng/' .number_format($item->price) .' VND' }}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-dark btn-sm show-service" data-toggle="modal" data-target="#modalService_charge" href="javascript:void(0);" data-id="{{$data->id}}" data-name="{{$data->name}}">
                                            <i class="fas fa-hand-holding-usd"></i>
                                            {{ __('messages.admin.service.table.service_charge') }}
                                        </a>  
                                        <a href="{{route('admin.service_type.edit', ['id_service' => $service->id, 'id' => $data->id])}}" class="btn btn-info btn-sm service_type-update btn-modal-form">
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
                                    <th>{{ __('messages.admin.service_type.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.service.table.service_charge') }}</th>
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