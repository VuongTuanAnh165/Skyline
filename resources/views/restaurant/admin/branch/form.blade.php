{{ csrf_field() }}
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">{{ __('messages.admin.branch.form.name') }}</label>
                    <input type="number" placeholder="{{  __('messages.admin.branch.form.name') }}" value="{{ isset($name) ? $name : (isset($data->name) ? $data->name : '') }}" disabled class="form-control">
                    <input type="hidden" name="name" placeholder="{{  __('messages.admin.branch.form.name') }}" value="{{ isset($name) ? $name : (isset($data->name) ? $data->name : '') }}" class="form-control">
                    @if ($errors->first('name'))
                    <div class="error error-be">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">{{ __('messages.admin.branch.form.address') }}</label>
                    <input type="text" name="address" id="address" placeholder="{{  __('messages.admin.branch.form.address') }}" value="{{ old('address') ? old('address') : (isset($data->address) ? $data->address : '') }}" class="form-control">
                    @if ($errors->first('address'))
                    <div class="error error-be">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="longitude">Kinh độ</label>
                            <input type="number" name="longitude" id="longitude" placeholder="{{  __('messages.admin.branch.form.longitude') }}" value="{{ old('longitude') ? old('longitude') : (isset($data->longitude) ? $data->longitude : '') }}" class="form-control">
                            @if ($errors->first('longitude'))
                            <div class="error error-be">{{ $errors->first('longitude') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="latitude">Vĩ độ</label>
                            <input type="number" name="latitude" id="latitude" placeholder="{{  __('messages.admin.branch.form.latitude') }}" value="{{ old('latitude') ? old('latitude') : (isset($data->latitude) ? $data->latitude : '') }}" class="form-control">
                            @if ($errors->first('latitude'))
                            <div class="error error-be">{{ $errors->first('latitude') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div wire:ignore id="map" style='width: 100%; height: 30vh;' ></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="open_time">{{ __('messages.admin.branch.form.open_time') }}</label>
                            <input type="time" name="open_time" id="open_time" placeholder="{{  __('messages.admin.branch.form.open_time') }}" value="{{ old('open_time') ? old('open_time') : (isset($data->open_time) ? $data->open_time : '') }}" class="form-control">
                            @if ($errors->first('open_time'))
                            <div class="error error-be">{{ $errors->first('open_time') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="close_time">{{ __('messages.admin.branch.form.close_time') }}</label>
                            <input type="time" name="close_time" id="close_time" placeholder="{{  __('messages.admin.branch.form.close_time') }}" value="{{ old('close_time') ? old('close_time') : (isset($data->close_time) ? $data->close_time : '') }}" class="form-control">
                            @if ($errors->first('close_time'))
                            <div class="error error-be">{{ $errors->first('close_time') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div id="" class="row">
                        <div class="col-lg-2">
                            <div id="upfile" class="btn-group w-100" data-token="{{ csrf_token() }}">
                                <span class="btn btn-success col fileinput-button">
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
                        @if(isset($data) && $data->background)
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row float-right">
    <div class="col-12">
        <button type="submit" class="btn btn-success">{{ __('messages.admin.form.save') }}</button>
    </div>
</div>