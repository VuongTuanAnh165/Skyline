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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ __('messages.admin.policy.table.name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('messages.admin.policy.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                            @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
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