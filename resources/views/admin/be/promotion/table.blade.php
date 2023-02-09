<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.promotion.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.promotion.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.type') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.condition') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.value') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.started_at') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.ended_at') }}</th>
                                    <th class="text-right">{{ __('messages.admin.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                @php
                                    $stt = 1;
                                    $nowDate = strtotime(Carbon\Carbon::now());
                                @endphp
                                @foreach($datas as $data)
                                <tr class="{{ ($nowDate > strtotime(Carbon\Carbon::parse($data->ended_at))) ? 'error' : '' }}">
                                    <td class="text-center">{{$stt}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center">{{$data->type == 1 ? 'Khuyến mãi dịch vụ' : 'Khuyến mãi hỗ trợ nhà hàng'}}</td>
                                    <td class="text-center">{{number_format($data->condition)}} VND</td>
                                    <td class="text-center">{{$data->type == 1 ? $data->value : number_format($data->value)}} {{$data->type == 1 ? '%' : 'VND'}}</td>
                                    <td class="text-center">{{$data->started_at}}</td>
                                    <td class="text-center">{{$data->ended_at}}</td>
                                    <td class="project-actions text-right">
                                        <a href="{{route('admin.promotion.edit', ['id'=>$data->id])}}" class="btn btn-info btn-sm promotion-update">
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
                                    <th>{{ __('messages.admin.promotion.table.name') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.type') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.condition') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.value') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.started_at') }}</th>
                                    <th class="text-center">{{ __('messages.admin.promotion.table.ended_at') }}</th>
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