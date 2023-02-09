@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.personnel.timekeeping.title') )
@section('addcss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web_admin/personnel/table.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs',
        [
            'breadcrumb'=> [
                ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
                ['title' => __('messages.admin.personnel.title'), 'url' => route('restaurant.personnel.index')],
                ['title' => __('messages.admin.personnel.timekeeping.title'), 'url' => '#']
            ]
        ])
@stop
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('messages.admin.personnel.timekeeping.title') }} {{ count($datas) <= 0 ? ': '.$personnel->name : '' }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="" data-toggle="modal" data-target="#modalAddTimekeeping" class="m-0 btn bg-gradient-success btn-lg">{{ __('messages.admin.table.timeKeeping') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.admin.personnel.timekeeping.table.title') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.title') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.date') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.checkin') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.checkout') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                @php
                                    $stt = 1;
                                    $timekeepingManager = new \App\Http\Controllers\Restaurant\RestaurantPersonnelController();
                                @endphp
                                @foreach($datas as $data)
                                @php 
                                    $timekeeping = $timekeepingManager->calcWorkingDuration($data);
                                    $date = $timekeeping['date'];
                                    $checked_in = $timekeeping['checked_in'];
                                    $checked_in_image = $timekeeping['checked_in_image'];
                                    $checked_out = $timekeeping['checked_out'];
                                    $checked_out_image = $timekeeping['checked_out_image'];
                                    $duration = $timekeeping['duration'];
                                    $late_join = $timekeeping['late_join'];
                                    $early_leave = $timekeeping['early_leave'];
                                    $shift_start = '';
                                    $shift_end = '';
                                    if($data->shift === $shifts['morning']) {
                                        $shift_start = $time_shift[0]['value'];
                                        $shift_end = $time_shift[1]['value'];
                                    } elseif($data->shift === $shifts['afternoon']) {
                                        $shift_start = $time_shift[2]['value'];
                                        $shift_end = $time_shift[3]['value'];
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{$stt}}</td>
                                    <td class="text-center">
                                        <img class="avatar-personnal" alt="" src="{{asset('storage/'.$data->avatar)}}" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';" >
                                        <span>{{ $data->name }}</span>
                                    </td>
                                    <td class="text-center">{{ $data->date }}</td>
                                    <td class="text-center {{ isset($checked_in) && isset($late_join) && $checked_in && $checked_in > strtotime($shift_start) ? 'text-danger' : '' }}">
                                        @if(isset($checked_in) && isset($late_join))
                                            @if($checked_in)
                                                {{date('H:i:s',$checked_in)}}
                                            @else
                                                <span class="text-danger"> {{ __('messages.admin.table.notCheck') }} </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center {{ isset($checked_out) && isset($early_leave) && $checked_out && $checked_out < strtotime($shift_end) ? 'text-danger' : '' }}">
                                        @if(isset($checked_out) && isset($early_leave))
                                            @if($checked_out)
                                                {{date('H:i:s',$checked_out)}}
                                            @else
                                                <span class="text-danger"> {{ __('messages.admin.table.notCheck') }} </span>
                                            @endif
                                        @endif
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
                                <tr>
                                    <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.title') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.date') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.checkin') }}</th>
                                    <th class="text-center">{{ __('messages.admin.personnel.timekeeping.table.checkout') }}</th>
                                </tr>
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
@include('restaurant.admin.personnel.timekeeping.modal-add-timekeeping')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    <script type="text/javascript">
        var data_model = 'personnel';
        $(document).ready(function () {
            $('.deleteDialog').on('click', function () {
                var data_id = $(this).data('id');
                destroy(data_id, data_model, "{{ route('ajax.destroy') }}", "{{ __('messages.common.areYouSure') }}");
            });
        });
    </script>
    @include('restaurant.admin.personnel.timekeeping.script')
@stop