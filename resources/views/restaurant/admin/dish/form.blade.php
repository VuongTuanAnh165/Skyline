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
                                    <label for="name">{{ $messages['dish']['table']['name'] }}</label>
                                    <input type="text" id="name" name="name" placeholder="{{ $messages['dish']['table']['name'] }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                                    @if ($errors->first('name'))
                                    <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @php
                                        $choose_category = old('category_id') ? old('category_id') : (isset($data->category_id) ? $data->category_id : '');
                                    @endphp
                                    <label for="category_id">{{ $messages['dish']['table']['category'] }}</label>
                                    <select class="form-control select2 category_id" id="category_id" name="category_id">
                                        <option value="">{{ $messages['dish']['table']['category'] }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($choose_category == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('category_id'))
                                    <div class="error error-be">{{ $errors->first('category_id') }}</div>
                                    @endif
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ $messages['dish']['table']['price'] }}</label>
                                    <input type="number" id="price" name="price" placeholder="{{ $messages['dish']['table']['price'] }}" value="{{ old('price') ? old('price') : (isset($data->price) ? $data->price : '') }}" class="form-control">
                                    @if ($errors->first('price'))
                                    <div class="error error-be">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    @php
                                        $choose_branch = old('branch_id') ? old('branch_id') : (isset($data->branch_id) ? $data->branch_id : []);
                                    @endphp
                                    <label for="branch_id">Chọn chi nhánh</label>
                                    <select class="form-control select2 branch_id" id="branch_id" name="branch_id[]" multiple>
                                        <option value="">Chọn chi nhánh</option>
                                        @foreach($branches as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id, $choose_branch)) selected @endif>Chi nhánh số: {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('branch_id'))
                                    <div class="error error-be">{{ $errors->first('branch_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    @php
                                        $choose_category_home = old('category_home_id') ? old('category_home_id') : (isset($data->category_home_id) ? $data->category_home_id : []);
                                    @endphp
                                    <label for="category_home_id">{{ $messages['dish']['table']['category_home'] }}</label>
                                    <select class="form-control select2 category_home_id" id="category_home_id" name="category_home_id[]" multiple>
                                        <option value="">{{ $messages['dish']['table']['category_home'] }}</option>
                                        @foreach($categoryHomes as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id, $choose_category_home)) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('category_home_id'))
                                    <div class="error error-be">{{ $errors->first('category_home_id') }}</div>
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