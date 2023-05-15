@php
    $collectMenu = old('menu_id') ? collect(old('menu_id')) : (isset($menuDish) && isset($data) ? $menuDish : collect());
@endphp
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ $messages['dish']['table']['name'] }}</label>
                                    <input type="text" id="name" name="name"
                                        placeholder="{{ $messages['dish']['table']['name'] }}"
                                        value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}"
                                        class="form-control">
                                    @if ($errors->first('name'))
                                        <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @php
                                        $choose_category = old('category_id') ? old('category_id') : (isset($data->category_id) ? $data->category_id : '');
                                    @endphp
                                    <label for="category_id">{{ $messages['dish']['table']['category'] }}</label>
                                    <select class="form-control select2 category_id" id="category_id"
                                        name="category_id">
                                        <option value="">{{ $messages['dish']['table']['category'] }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($choose_category == $category->id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('category_id'))
                                        <div class="error error-be">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">{{ $messages['dish']['table']['price'] }}</label>
                                    <input type="number" id="price" name="price"
                                        placeholder="{{ $messages['dish']['table']['price'] }}"
                                        value="{{ old('price') ? old('price') : (isset($data->price) ? $data->price : '') }}"
                                        class="form-control">
                                    @if ($errors->first('price'))
                                        <div class="error error-be">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php
                                        $choose_branch = old('branch_id') ? old('branch_id') : (isset($data->branch_id) ? $data->branch_id : []);
                                    @endphp
                                    <label for="branch_id">Chọn chi nhánh</label>
                                    <select class="form-control select2 branch_id" id="branch_id" name="branch_id[]"
                                        multiple>
                                        <option value="">Chọn chi nhánh</option>
                                        @foreach ($branches as $item)
                                            <option value="{{ $item->id }}"
                                                @if (in_array($item->id, $choose_branch)) selected @endif>Chi nhánh số:
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('branch_id'))
                                        <div class="error error-be">{{ $errors->first('branch_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="menu_id">Chọn Menu</label>
                                    <select class="form-control select2 menu_id" id="menu_id" name="menu_id[]"
                                        multiple>
                                        <option value="">Chọn menu</option>
                                        @foreach ($menus as $menu)
                                            <option value={{ $menu->id }}
                                                {{ $collectMenu->contains($menu->id) ? 'selected' : '' }}>
                                                {{ $menu->name }} ({{ $menu->describe }})</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('menu_id'))
                                        <div class="error error-be">{{ $errors->first('menu_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php
                                        $choose_category_home = old('category_home_id') ? old('category_home_id') : (isset($data->category_home_id) ? $data->category_home_id : []);
                                    @endphp
                                    <label
                                        for="category_home_id">{{ $messages['dish']['table']['category_home'] }}</label>
                                    <select class="form-control select2 category_home_id" id="category_home_id"
                                        name="category_home_id[]" multiple>
                                        <option value="">{{ $messages['dish']['table']['category_home'] }}
                                        </option>
                                        @foreach ($categoryHomes as $item)
                                            <option value="{{ $item->id }}"
                                                @if (in_array($item->id, $choose_category_home)) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('category_home_id'))
                                        <div class="error error-be">{{ $errors->first('category_home_id') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="content">{{ __('messages.admin.restaurant.form.content') }}</label><br>
                            <textarea class="form-control" rows="10" id="summernote" name='content'>
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
    <div class="col-md-10">
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
                                    <span>Image</span>
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
                                    <button class="btn btn-primary start btn-disabled-none d-none" disabled>
                                        <i class="fas fa-upload"></i>
                                        <span></span>
                                    </button>
                                    <div class="btn btn-danger delete">
                                        <i class="fas fa-trash"></i>
                                        <span>{{ __('messages.admin.restaurant.form.deleteFile') }}</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="image[]" value="">
                        </div>
                        @if (isset($data) && $data->image)
                            @foreach ($data->image as $value)
                                <div class="row mt-2 file-row file-row-old">
                                    <div class="col-auto">
                                        <span class="preview"><img src="{{ asset('storage/' . $value) }}"
                                                alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name>{{ $value }}</span>
                                            <span data-dz-size></span>
                                        </p>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start btn-disabled-none d-none" disabled>
                                                <i class="fas fa-upload"></i>
                                                <span></span>
                                            </button>
                                            <div class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>{{ __('messages.admin.restaurant.form.deleteFile') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="image[]" value="{{ $value }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($errors->first('image'))
                        <div class="error error-be">{{ $errors->first('image') }}</div>
                    @endif
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
