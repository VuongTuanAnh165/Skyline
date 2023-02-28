<div class="modal fade" id="modalFormimage" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-customer" id="form-category" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title title-form-category">{{ __('messages.admin.category.create.title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $choose_type = old('type') ? old('type') : (isset($data->type) ? $data->type : 0);
                            @endphp
                            <div class="row form-type">
                                <div class="col-md-12">
                                    <label for="type">{{ __('messages.admin.image.table.type') }}</label><br>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_admin" name="type" value="0" {{ ($choose_type == 0) ? 'checked' : '' }}>
                                            <label for="web_admin">{{ __('messages.admin.image.type')[0] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_customer" name="type" value="1" {{ ($choose_type == 1) ? 'checked' : '' }}>
                                            <label for="web_customer">{{ __('messages.admin.image.type')[1] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_restaurant" name="type" value="2" {{ ($choose_type == 2) ? 'checked' : '' }}>
                                            <label for="web_restaurant">{{ __('messages.admin.image.type')[2] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_sell" name="type" value="3" {{ ($choose_type == 3) ? 'checked' : '' }}>
                                            <label for="web_sell">{{ __('messages.admin.image.type')[3] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_service" name="type" value="4" {{ ($choose_type == 4) ? 'checked' : '' }}>
                                            <label for="web_service">{{ __('messages.admin.image.type')[4] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_user_shop" name="type" value="5" {{ ($choose_type == 5) ? 'checked' : '' }}>
                                            <label for="web_user_shop">{{ __('messages.admin.image.type')[5] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="web_user_food" name="type" value="6" {{ ($choose_type == 6) ? 'checked' : '' }}>
                                            <label for="web_user_food">{{ __('messages.admin.image.type')[6] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="app_user_sell" name="type" value="7" {{ ($choose_type == 7) ? 'checked' : '' }}>
                                            <label for="app_user_sell">{{ __('messages.admin.image.type')[7] }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline radio-type">
                                            <input type="radio" id="app_sell" name="type" value="8" {{ ($choose_type == 8) ? 'checked' : '' }}>
                                            <label for="app_sell">{{ __('messages.admin.image.type')[8] }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->first('type'))
                            <div class="error error-be">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-logo">
                                <label for="logo" class="control-label">Image</label>
                                <div class="upload-logo">
                                    <input class="up-logo check" value="" accept="image/*" type="file" id="imgInp" name="image"
                                        data-msg-accept="{{ __('validation.form.image') }}" />
                                        <img id="blah" src="" class="image-restaurant check">
                                </div>
                                @if ($errors->first('logo'))
                                    <div class="error error-commit">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <div id="btn-submit-category" data-id="" data-url="" class="btn btn-primary">{{ __('messages.admin.form.save') }}</div>
                </div>
            </form>
        </div>
    </div>
</div>