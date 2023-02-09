<div class="modal fade" id="modalFormCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-customer" id="form-category" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title title-form-category">{{ $messages['category']['create']['title'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ $messages['category']['table']['name'] }}</label>
                        <input type="text" id="name" name="name" placeholder="{{  $messages['category']['table']['name'] }}" value="{{ old('name') ? old('name') : '' }}" class="form-control check">
                        @if ($errors->first('name'))
                        <div class="error error-be">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group form-logo">
                        <label for="logo" class="control-label">Image</label>
                        <div class="upload-logo">
                            <input class="up-logo check" accept="image/*" type="file" id="imgInp" name="image"
                                data-msg-accept="{{ __('validation.form.image') }}" />
                                <img id="blah" src="" class="image-restaurant check" onerror="this.onerror=null;this.src='{{ asset('img/default_logo.png') }}';">
                        </div>
                        @if ($errors->first('logo'))
                            <div class="error error-commit">{{ $errors->first('logo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btn-submit-category" data-id="" data-url="" class="btn btn-primary">{{ __('messages.admin.form.save') }}</div>
                </div>
            </form>
        </div>
    </div>
</div>