@extends('restaurant.sell.layouts.master')
@section('title', 'Danh sách hóa đơn ăn tại quán' )
@section('addcss')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_web_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/web_sell/eat/style.css') }}">
@stop
@section('content')
<div class="container-header row">
    <a href="{{ route('sell.restaurant.eat.index') }}" class="col-md-6 alert alert-secondary header-a">
        Tạo hóa đơn
    </a>
    <a href="{{ route('sell.restaurant.eat.order') }}" class="col-md-6 alert alert-danger header-a">
        Hóa đơn
    </a>
</div>
<div style="padding-top: 55px;" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h4 style="margin: 0;" class="card-title">Bảng danh sách hóa đơn ăn tại quán</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('messages.admin.table.stt') }}</th>
                                <th>ID hóa đơn</th>
                                <th>Bàn</th>
                                <th class="text-center">Thành tiền</th>
                                <th class="text-center">Ngày thanh toán</th>
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
                                    $create_by = $data->create_by ? ( $data->create_by != -1 ? \App\Models\Personnel::select('name')->find($data->create_by)->name : __('messages.admin.table.manage') ) : '';
                                    $update_by = $data->update_by ? ( $data->update_by != -1 ? \App\Models\Personnel::select('name')->find($data->update_by)->name : __('messages.admin.table.manage') ) : '';
                                    $tables = \App\Models\Table::whereIn('id', $data->table_id)->get();
                                @endphp
                                <td class="text-center">{{$stt}}</td>
                                <td>{{ $data->order_id }}</td>
                                <td>
                                    <ul>
                                        @foreach($tables as $table)
                                            <li>Bàn số: {{$table->name}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">{{ number_format($data->total_money) }} VND</td>
                                <td class="text-center">{{ $data->implementation_date }}</td>
                                <td class="text-center">{{ $create_by }}</td>
                                <td class="text-center">{{ $update_by }}</td>
                                <td class="project-actions text-right">
                                    <a target="_blank" href="{{ route('sell.restaurant.eat.print', ['id' => $data->id]) }}" class="btn btn-info btn-sm post-update">
                                        <i class="fas fa-receipt"></i>
                                        Xem hóa đơn
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
                                <th>ID hóa đơn</th>
                                <th class="text-center">Bàn</th>
                                <th class="text-center">Thành tiền</th>
                                <th class="text-center">Ngày thanh toán</th>
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
    </div>
</div>
@stop
@section('addjs')
@if (session('success') || session('error'))
@include('restaurant.sell.partials.script.toastr')
@endif
@include('restaurant.sell.restaurant.eat.script_order')
@stop