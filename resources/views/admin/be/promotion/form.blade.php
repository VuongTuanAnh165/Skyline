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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">{{ __('messages.admin.promotion.table.name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('messages.admin.promotion.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                            @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            @php
                            $choose_type = old('type') ? old('type') : (isset($data->type) ? $data->type : 1);
                            @endphp
                            <label for="type">Loại chương trình khuyến mãi</label><br>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="admin_service" name="type" value="1" {{ ($choose_type == 1) ? 'checked' : '' }}>
                                <label for="admin_service">Khuyến mại dịch vụ</label>
                            </div>
                            <div class="icheck-primary d-inline radio-type">
                                <input type="radio" id="admin_restaurant" name="type" value="2" {{ ($choose_type == 2) ? 'checked' : '' }}>
                                <label for="admin_restaurant">Khuyến mại hỗ trợ nhà hàng</label>
                            </div>
                            @if ($errors->first('type'))
                            <div class="error error-be">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="condition">{{ __('messages.admin.promotion.table.condition') }}</label><br>
                            <input style="display: inline; width: 80%;" type="number" id="condition" name="condition" placeholder="{{ __('messages.admin.promotion.table.condition') }}" value="{{ old('condition') ? old('condition') : (isset($data->condition) ? $data->condition : '') }}" class="form-control">
                            <label for="condition">VND</label>
                            @if ($errors->first('condition'))
                            <div class="error error-be">{{ $errors->first('condition') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="value">{{ __('messages.admin.promotion.table.value') }}</label><br>
                            <input style="display: inline; width: 80%;" type="number" id="value" name="value" placeholder="{{ __('messages.admin.promotion.table.value') }}" value="{{ old('value') ? old('value') : (isset($data->value) ? $data->value : '') }}" class="form-control">
                            <label for="value" class="lable-value"></label>
                            @if ($errors->first('value'))
                            <div class="error error-be">{{ $errors->first('value') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="started_at">{{ __('messages.admin.promotion.table.started_at') }}</label><br>
                            <input type="date" id="started_at" name="started_at" placeholder="{{ __('messages.admin.promotion.table.started_at') }}" value="{{ old('started_at') ? old('started_at') : (isset($data->started_at) ? $data->started_at : '') }}" class="form-control">
                            @if ($errors->first('started_at'))
                            <div class="error error-be">{{ $errors->first('started_at') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ended_at">{{ __('messages.admin.promotion.table.ended_at') }}</label><br>
                            <input type="date" id="ended_at" name="ended_at" placeholder="{{ __('messages.admin.promotion.table.ended_at') }}" value="{{ old('ended_at') ? old('ended_at') : (isset($data->ended_at) ? $data->ended_at : '') }}" class="form-control">
                            @if ($errors->first('ended_at'))
                            <div class="error error-be">{{ $errors->first('ended_at') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-logo">
                            <label for="logo" class="control-label">Image</label>
                            <div class="upload-logo">
                                <input class="up-logo check" value="" accept="image/*" type="file" id="imgInp" name="image" data-msg-accept="{{ __('validation.form.image') }}" />
                                <img id="blah" src="{{ isset($data) ? asset('storage/'.$data->image) : '' }}" class="image-restaurant check" onerror="this.onerror=null;this.src=`{{ asset('img/background_default.jpg') }}`;">
                            </div>
                            @if ($errors->first('logo'))
                            <div class="error error-commit">{{ $errors->first('logo') }}</div>
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