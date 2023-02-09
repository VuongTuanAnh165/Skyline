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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.admin.service.table.name') }}</label>
                                    <input type="text" id="name" name="name" placeholder="{{ __('messages.admin.service.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                                    @if ($errors->first('name'))
                                    <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @php
                                        $choose_service_group = old('service_group_id') ? old('service_group_id') : (isset($data->service_group_id) ? $data->service_group_id : '');
                                    @endphp
                                    <label for="service_group_id">{{ __('messages.admin.service_group.title') }}</label>
                                    <select class="form-control select2 service_group_id" id="service_group_id" name="service_group_id">
                                        <option value=""></option>
                                        @foreach($service_groups as $item)
                                        <option value="{{$item->id}}"  @if($choose_service_group == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('service_group_id'))
                                    <div class="error error-be">{{ $errors->first('service_group_id') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @php
                                        $choose_show_home = old('show_home') ? old('show_home') : (isset($data->show_home) ? $data->show_home : 0);
                                    @endphp
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="show_home" id="customCheckbox1" value="1" {{ ($choose_show_home==1) ? 'checked' : '' }}>
                                        <label for="customCheckbox1" class="custom-control-label">Hiển thị tại trang chủ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-logo">
                                    <label for="logo" class="control-label">Image</label>
                                    <div class="upload-logo">
                                        <input class="up-logo" accept="image/*" type="file" id="imgInp" name="image" data-msg-accept="{{ __('validation.form.image') }}" value="{{ old('image') ? old('image') : (isset($data->image) ? $data->image : '') }}" />
                                        <img id="blah" src="{{ isset($data) ? asset('storage/'.$data->image) : '' }}" class="avatar-personnel" onerror="this.onerror=null;this.src='{{ asset('img/default_logo.png') }}';">
                                    </div>
                                    @if ($errors->first('image'))
                                    <div class="error error-be">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content">{{ __('messages.admin.restaurant.form.content') }}</label><br>
                            <textarea class="form-control" rows="7" id="summernote" name='content'>
                                {{ old('content', $data->content ?? '') }}
                            </textarea>
                            @if ($errors->first('content'))
                                <div class="error error-be">{{ $errors->first('content') }}</div>
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