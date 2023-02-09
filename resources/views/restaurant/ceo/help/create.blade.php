@extends('restaurant.ceo.layouts.master')
@section('title', 'Gửi câu hỏi' )
@section('addcss')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .form-group .select2-container .select2-selection--single {
            height: 40.609px;
            border-radius: 0px;
            border: 1px solid #ced4da;
        }
    </style>
@stop
@section('content')
@section('addBreadcrumb')
@include('restaurant.ceo.partials.breadcrumbs',
    [
    'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('ceo.home.index')],
            ['title' => 'Quản lý câu hỏi', 'url' => route('ceo.help.index')],
            ['title' => 'Gửi câu hỏi', 'url' => '#']
        ]
    ])
@stop

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gửi câu hỏi</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form method="POST" action="{{ route('ceo.help.store') }}" class="form-customer" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                        $choose_service_id = old('service_id') ? old('service_id') : '';
                                    @endphp
                                    <label for="service_id">Chọn dịch vụ</label>
                                    <select class="form-control select2 service_id" name="service_id">
                                        <option value="">Chọn dịch vụ</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" @if($service->id == old('service_id')) selected @endif)> {{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('service_id'))
                                    <div class="error error-be">{{ $errors->first('service_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question">Câu hỏi</label><br>
                                    <textarea class="form-control" id="question" rows="7" name='question'>
                                    {{ old('question' ?? '') }}
                                    </textarea>
                                    @if ($errors->first('question'))
                                    <div class="error error-be">{{ $errors->first('question') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-save">{{ __('messages.admin.form.save') }}</button>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@stop
@section('addjs')
    @include('restaurant.ceo.help.script_form')
@stop