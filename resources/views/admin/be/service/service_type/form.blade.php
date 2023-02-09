{{ csrf_field() }}
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.admin.service_type.table.name') }}</label>
                                    <input type="text" id="name" name="name" placeholder="{{ __('messages.admin.service_type.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                                    @if ($errors->first('name'))
                                    <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.admin.post.table.description') }}</label>
                                    <input type="text" id="description" name="description" placeholder="{{ __('messages.admin.post.table.description') }}" value="{{ old('description') ? old('description') : (isset($data->description) ? $data->description : '') }}" class="form-control">
                                    @if ($errors->first('description'))
                                    <div class="error error-be">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dịch vụ sử dụng</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="accordion">
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                {{($service->id == 1) ? 'Quản lý nhà hàng' : 'Quản lý cửa hàng'}}
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($price_lists as $price_list)
                                                    @if($price_list->type_service == 1)
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="{{ $price_list->value_request }}">{{ $types[$price_list->name] }}</label><br>
                                                                <input type="hidden" name="{{ $price_list->id_request }}" value="{{$price_list->id}}">
                                                                @if($price_list->type_list == 1)
                                                                    <input type="number" id="{{ $price_list->value_request }}" name="{{ $price_list->value_request }}" placeholder="{{ $types[$price_list->name] }}" value="{{ old($price_list->value_request) ? old($price_list->value_request) : (isset($data->price_list[$price_list->id]) ? $data->price_list[$price_list->id] : '') }}" class="form-control">
                                                                @else
                                                                    @php
                                                                        $choose_price_list = old($price_list->value_request) ? old($price_list->value_request) : (isset($data->price_list[$price_list->id]) ? $data->price_list[$price_list->id] : -1);
                                                                    @endphp
                                                                    <div class="icheck-primary d-inline radio-type">
                                                                        <input type="radio" id="{{ $price_list->value_request . '_yes' }}" name="{{ $price_list->value_request }}" value="-1" {{ ($choose_price_list == -1) ? 'checked' : '' }}>
                                                                        <label for="{{ $price_list->value_request . '_yes' }}">Có</label>
                                                                    </div>
                                                                    <div class="icheck-primary d-inline radio-type">
                                                                        <input type="radio" id="{{ $price_list->value_request . '_no' }}" name="{{ $price_list->value_request }}" value="-2" {{ ($choose_price_list == -2) ? 'checked' : '' }}>
                                                                        <label for="{{ $price_list->value_request . '_no' }}">Không</label>
                                                                    </div>
                                                                @endif
                                                                @if ($errors->first($price_list->value_request))
                                                                    <div class="error error-be">{{ $errors->first($price_list->value_request) }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Quản lý bán hàng
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($price_lists as $price_list)
                                                    @if($price_list->type_service == 2)
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="{{ $price_list->value_request }}">{{ $types[$price_list->name] }}</label><br>
                                                                @if($price_list->type_list == 1)
                                                                    <input type="number" id="{{ $price_list->value_request }}" name="{{ $price_list->value_request }}" placeholder="{{ $types[$price_list->name] }}" value="{{ old($price_list->value_request) ? old($price_list->value_request) : (isset($data->price_list[$price_list->id]) ? $data->price_list[$price_list->id] : '') }}" class="form-control">
                                                                @else
                                                                    @php
                                                                        $choose_price_list = old($price_list->value_request) ? old($price_list->value_request) : (isset($data->price_list[$price_list->id]) ? $data->price_list[$price_list->id] : -1);
                                                                    @endphp
                                                                    <div class="icheck-primary d-inline radio-type">
                                                                        <input type="radio" id="{{ $price_list->value_request . '_yes' }}" name="{{ $price_list->value_request }}" value="-1" {{ ($choose_price_list == -1) ? 'checked' : '' }}>
                                                                        <label for="{{ $price_list->value_request . '_yes' }}">Có</label>
                                                                    </div>
                                                                    <div class="icheck-primary d-inline radio-type">
                                                                        <input type="radio" id="{{ $price_list->value_request . '_no' }}" name="{{ $price_list->value_request }}" value="-2" {{ ($choose_price_list == -2) ? 'checked' : '' }}>
                                                                        <label for="{{ $price_list->value_request . '_no' }}">Không</label>
                                                                    </div>
                                                                @endif
                                                                @if ($errors->first($price_list->value_request))
                                                                    <div class="error error-be">{{ $errors->first($price_list->value_request) }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-success btn-save">{{ __('messages.admin.form.save') }}</button>
    </div>
</div>