<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.personnel.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th>{{ __('messages.admin.personnel.table.name') }}</th>
                                    <th>{{ __('messages.admin.personnel.table.email') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.table.phone') }}</th>
                                    <th>{{ __('messages.admin.personnel.table.hometown') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.table.position') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.form.shift') }}</th>
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
                                    <td>
                                        <img class="avatar-personnal" alt="" src="{{asset('storage/'.$data->avatar)}}" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';" >
                                        <span>{{ $data->name }}</span>
                                    </td>
                                    <td>{{ $data->email }}</td>
                                    <td class="text-center">{{ $data->phone }}</td>
                                    <td>{{ $data->commune_name . ' - ' . $data->district_name . ' - ' . $data->province_name }}</td>
                                    <td class="text-center">{{ $data->position_name }}</td>
                                    <td class="text-center">{{ $data->work_type === 1 ? __('messages.admin.position.full') : ($data->work_type === 0 ?  __('messages.admin.position.part') : '') }}<br>{{!empty($data->shift_name) ? 'Ca ' . $data->shift_name . ' (' . $data->start . ' - ' . $data->end .')' : ''}}</td>
                                    <td class="project-actions text-right">
                                        <div class="row">
                                            <a href="{{route('restaurant.personnel.givePassword', ['id'=>$data->id])}}" class="btn bg-gradient-warning btn-sm col-6">
                                                <i class="fas fa-key"></i>
                                                {{ __('messages.admin.personnel.form.givePassword') }}
                                            </a>
                                            <a href="{{route('restaurant.personnel.timekeeping', ['id'=>$data->id])}}" class="btn bg-teal btn-sm col-6">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ __('messages.admin.table.timeKeeping') }}
                                            </a>
                                        </div>
                                        <div class="row">
                                            <a href="{{route('restaurant.personnel.edit', ['id'=>$data->id])}}" class="btn btn-info btn-sm personnel-update col-6">
                                                <i class="fas fa-pencil-alt"></i>
                                                {{ __('messages.admin.table.edit') }}
                                            </a>
                                            <a class="btn btn-danger btn-sm deleteDialog tip" href="javascript:void(0);" data-id="{{$data->id}} col-6">
                                                <i class="fas fa-trash"></i>
                                                {{ __('messages.admin.table.destroy') }}
                                            </a>                                 
                                        </div>
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
                                    <th>{{ __('messages.admin.personnel.table.name') }}</th>
                                    <th>{{ __('messages.admin.personnel.table.email') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.table.phone') }}</th>
                                    <th>{{ __('messages.admin.personnel.table.hometown') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.table.position') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.form.shift') }}</th>
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