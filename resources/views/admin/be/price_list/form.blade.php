{{ csrf_field() }}
<div class="row">
    <div class="col-md-8">
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
                                $choose_name = old('name') ? old('name') : (isset($data->name) ? $data->name : -1);
                            @endphp
                            <label for="name">Chọn lựa chọn</label>
                            <select class="form-control select2 name" id="name" name="name">
                                <option value="">Lựa chọn</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" @if($choose_name == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            @php
                                $choose_service = old('service_id') ? old('service_id') : (isset($data->service_id) ? $data->service_id : '');
                            @endphp
                            <label for="service_id">Dịch vụ</label>
                            <select class="form-control select2 service_id" id="service_id" name="service_id">
                                <option value="">Dịch vụ</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" @if($choose_service == $service->id) selected @endif>{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('service_id'))
                            <div class="error error-be">{{ $errors->first('service_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            @php
                                $choose_model = old('model') ? old('model') : (isset($data->model) ? $data->model : -1);
                            @endphp
                            <label for="model">Chọn Model</label>
                            <select class="form-control select2 model" id="model" name="model">
                                <option value="">Model</option>
                                @foreach($models as $key => $value)
                                    <option value="{{ $key }}" @if($choose_model == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('model'))
                            <div class="error error-be">{{ $errors->first('model') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            @php
                            $choose_type_service = old('type_service') ? old('type_service') : (isset($data->type_service) ? $data->type_service : 1);
                            @endphp
                            <label for="type_service">Loại quản lý dịch vụ</label><br>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="restaurant_shop" name="type_service" value="1" {{ ($choose_type_service == 1) ? 'checked' : '' }}>
                                <label for="restaurant_shop">Lựa chọn dành cho nhà hàng/shop</label>
                            </div>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="sell" name="type_service" value="2" {{ ($choose_type_service == 2) ? 'checked' : '' }}>
                                <label for="sell">Lựa chọn dành cho bán hàng</label>
                            </div>
                            @if ($errors->first('type_service'))
                            <div class="error error-be">{{ $errors->first('type_service') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            @php
                            $choose_type_list = old('type_list') ? old('type_list') : (isset($data->type_list) ? $data->type_list : 1);
                            @endphp
                            <label for="type_list">Loại giá trị</label><br>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="choose_text" name="type_list" value="1" {{ ($choose_type_list == 1) ? 'checked' : '' }}>
                                <label for="choose_text">Cho phép nhập giá trị</label>
                            </div>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="choose_boolean" name="type_list" value="2" {{ ($choose_type_list == 2) ? 'checked' : '' }}>
                                <label for="choose_boolean">Kiểu True/False</label>
                            </div>
                            @if ($errors->first('type_list'))
                            <div class="error error-be">{{ $errors->first('type_list') }}</div>
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