<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $messages['dish']['table']['title'] }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ $messages['dish']['table']['name'] }}</th>
                                    <th class="text-center">{{ $messages['dish']['table']['category'] }}</th>
                                    <th class="text-center">{{ $messages['dish']['table']['price'] }}</th>
                                    <th class="text-left">{{ $messages['menu']['title'] }}</th>
                                    <th class="text-center">{{ __('messages.admin.table.create_by') }}</th>
                                    <th class="text-center">{{ __('messages.admin.table.update_by') }}</th>
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
                                    @php
                                        $create_by = $data->create_by ? ( $data->create_by != -1 ? \App\Models\Personnel::select('name')->find($data->create_by)->name : __('messages.admin.table.manage') )  : '';
                                        $update_by = $data->update_by ? ( $data->update_by != -1 ? \App\Models\Personnel::select('name')->find($data->update_by)->name : __('messages.admin.table.manage') )  : '';
                                    @endphp
                                    <td class="text-center">{{$stt}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->category_name }}</td>
                                    <td class="text-center">{{ number_format($data->price) }} VND</td>
                                    <td>{{ $data->menu_name }}</td>
                                    <td class="text-center">{{ $create_by }}</td>
                                    <td class="text-center">{{ $update_by }}</td>
                                    <td class="project-actions text-right">
                                        <a href="{{route('restaurant.dish.edit', ['id'=>$data->id])}}" class="btn btn-info btn-sm dish-update">
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
                                    <th>{{ $messages['dish']['table']['name'] }}</th>
                                    <th class="text-center">{{ $messages['dish']['table']['category'] }}</th>
                                    <th class="text-center">{{ $messages['dish']['table']['price'] }}</th>
                                    <th class="text-center">{{ $messages['menu']['title'] }}</th>
                                    <th class="text-center">{{ __('messages.admin.table.create_by') }}</th>
                                    <th class="text-center">{{ __('messages.admin.table.update_by') }}</th>
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