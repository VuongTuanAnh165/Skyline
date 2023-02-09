@extends('restaurant.admin.layouts.master')
@section('title', __('messages.admin.restaurant.title') )
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_admin/restaurant/form.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
@stop
@section('content')
@section('addBreadcrumb')
    @include('restaurant.admin.partials.breadcrumbs',
    [
        'breadcrumb'=> [
            ['title' => __('messages.admin.home'), 'url' => route('restaurant.home.index')],
            ['title' => __('messages.admin.restaurant.title'), 'url' => '#']
        ]
    ])
@stop
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <form method="POST" action="{{ route('restaurant.restaurant.update') }}" class="form-customer" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12 col-sm-6">
                        @php
                            $ceo = \App\Models\Ceo::find($data->ceo_id);
                        @endphp
                        <h3 class="my-3">Chủ sở hữu: {{$ceo->name}}</h3>
                        @if($data->background)
                            <div class="col-12 product-image-background">
                                <img src="{{asset('storage/'. $data->background[0])}}" class="product-image" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                            @foreach($data->background as $value)
                                <div class="product-image-thumb {{ ($background == $value) ? 'active' : ''}}"><img src="{{asset('storage/'. $value)}}" alt="Product Image"></div>
                            @endforeach
                        </div>
                        @else
                            <div class="col-12">
                                <img src="{{ asset('img/background_default.jpg') }}" class="product-image" alt="Product Image">
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="row row-title-restaurant">
                            <div class="col-6">
                                <h3 class="my-3">{{ __('messages.admin.restaurant.showTitle') }}</h3>
                            </div>
                            <div class="col-6 col-btn-edit">
                                <div data-toggle="modal" data-target="#modalChangePassword" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-key"></i>
                                    {{ __('messages.admin.restaurant.changePassword') }}
                                </div>
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="fas fa-pencil-alt"></i>
                                    {{ __('messages.admin.restaurant.edit') }}
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.admin.restaurant.form.name') }}</label><br>
                                            <input class="effect-6 form-control" id="name" name="name" value="{{ old('name', $data->name ?? '') }}" type="text" placeholder="{{ __('messages.admin.restaurant.form.name') }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->first('name'))
                                                <div class="error error-be">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('messages.admin.restaurant.form.phone') }}</label><br>
                                            <input class="effect-6 form-control" id="phone" name="phone" value="{{ old('phone', $data->phone ?? '') }}" type="text" placeholder="{{ __('messages.admin.restaurant.form.phone') }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->first('phone'))
                                                <div class="error error-be">{{ $errors->first('phone') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.admin.restaurant.form.email') }}</label><br>
                                            <input class="effect-6 form-control" id="email" name="email" value="{{ old('email', $data->email ?? '') }}" type="text" placeholder="{{ __('messages.admin.restaurant.form.email') }}">
                                            <span class="focus-border"></span>
                                            @if ($errors->first('email'))
                                                <div class="error error-be">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group form-logo">
                                    <label for="logo" class="control-label">Logo</label>
                                    <div class="upload-logo">
                                        <input class="up-logo" accept="image/*" type="file" id="imgInp" name="logo"
                                            data-msg-accept="{{ __('validation.form.image') }}" />
                                            <img id="blah" src="{{asset('storage/'.$data->logo)}}" class="logo-restaurant" onerror="this.onerror=null;this.src='{{ asset('img/default_logo.png') }}';">
                                    </div>
                                    @if ($errors->first('logo'))
                                        <div class="error error-commit">{{ $errors->first('logo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="client_id">Client ID</label><br>
                                    <input class="effect-6 form-control" id="client_id" name="client_id" value="{{ old('client_id', $data->client_id ?? '') }}" type="text" placeholder="Client ID">
                                    <span class="focus-border"></span>
                                    @if ($errors->first('client_id'))
                                        <div class="error error-be">{{ $errors->first('client_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="secret">Secret</label><br>
                                    <input class="effect-6 form-control" id="secret" name="secret" value="{{ old('secret', $data->secret ?? '') }}" type="text" placeholder="Secret">
                                    <span class="focus-border"></span>
                                    @if ($errors->first('secret'))
                                        <div class="error error-be">{{ $errors->first('secret') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="content">{{ __('messages.admin.restaurant.form.content') }}</label><br>
                            <textarea class="form-control" rows="5" id="summernote" name='content'>
                                {{ old('content', $data->content ?? '') }}
                            </textarea>
                            @if ($errors->first('content'))
                                <div class="error error-be">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('messages.admin.restaurant.form.background') }}</h3>
                        </div>
                        <div class="card-body form-group">
                            <div id="" class="row">
                                <div class="col-lg-2">
                                    <div id="upfile" class="btn-group w-100" data-token="{{ csrf_token() }}">
                                        <span class="btn btn-success col fileinput-button">
                                            <i class="fas fa-plus"></i>
                                            <span>{{ __('messages.admin.restaurant.form.addFile') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table table-striped files" id="previews">
                                <div id="template" class="row mt-2 file-row">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            <span data-dz-size></span>
                                        </p>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start btn-disabled-none" disabled>
                                                <i class="fas fa-upload"></i>
                                                <span></span>
                                            </button>
                                            <div class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>{{ __('messages.admin.restaurant.form.deleteFile') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="background[]" value="">
                                </div>
                                @if($data->background)
                                    @foreach($data->background as $value)
                                        <div class="row mt-2 file-row file-row-old">
                                            <div class="col-auto">
                                                <span class="preview"><img src="{{asset('storage/'. $value)}}" alt="" data-dz-thumbnail /></span>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    <span class="lead" data-dz-name>{{ $value }}</span>
                                                    <span data-dz-size></span>
                                                </p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary start btn-disabled-none" disabled>
                                                        <i class="fas fa-upload"></i>
                                                        <span></span>
                                                    </button>
                                                    <div class="btn btn-danger delete">
                                                        <i class="fas fa-trash"></i>
                                                        <span>{{ __('messages.admin.restaurant.form.deleteFile') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="background[]" value="{{$value}}">
                                        </div>
                                    @endforeach                                  
                                @endif
                            </div>
                            @if ($errors->first('background'))
                                <div class="error error-be">{{ $errors->first('background') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@include('restaurant.admin.restaurant.modal-change-password')
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('restaurant.admin.partials.script.toastr')
    @endif
    @include('restaurant.admin.restaurant.script')
@stop