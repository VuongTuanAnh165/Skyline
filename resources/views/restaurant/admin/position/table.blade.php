<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.position.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.position.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.wage') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.work_type') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.amount_personnel') }}</th>
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
                                    <td class="text-center">{{ number_format($data->wage) }}</td>
                                    <td class="text-center">
                                        @foreach($data->work_type as $item)
                                            @if($item == $full)
                                                <div>{{ __('messages.admin.position.full') }}</div>
                                            @endif
                                            @if($item == $part)
                                                <div>{{ __('messages.admin.position.part') }}</div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $data->amount_personnel }}</td>
                                    <td class="project-actions text-right">
                                        <a href="" data-id="{{$data->id}}" data-toggle="modal" data-target="#modalFormPosition" data-url="{{ route('restaurant.position.update', ['id' => $data->id]) }}" class="btn btn-info btn-sm position-update btn-modal-form">
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
                                    <th>{{ __('messages.admin.position.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.wage') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.work_type') }}</th>
                                    <th class="text-center">{{ __('messages.admin.position.table.amount_personnel') }}</th>
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