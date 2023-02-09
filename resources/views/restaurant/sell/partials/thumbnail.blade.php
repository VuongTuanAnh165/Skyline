<div class="widget meta-boxes">
    <div class="widget-title">
        <h4><label for="image" class="control-label">{{  __('admin::messages.table.avatar') }}</label>
        </h4>
    </div>
    <div class="widget-body">
        <div class="image-box">
            <input id="body-image" type="file"
                   name="file"
                   value=""
                   class="image-data input-file" style="display: none;"
                   accept="image/*"
                   data-preview="holder">
            <label for="body-image" class="input-file"></label>
            <input type="hidden" name="avatar" value="{{ (isset($data) && $data->avatar) ?  $data->avatar : '' }}">
            <input type="hidden" name="image_base64" value="">
            <div class="preview-image-wrapper ">
                @if( isset($data) && $data->avatar )
                    <img id="holder" class="preview_image"
                         src="{{ asset($data->avatar) }}"
                         alt="preview image">
                @else
                    <img id="holder" class="preview_image"
                         src="{{ asset('admin/images/placeholder.png') }}"
                         alt="preview image">
                @endif
                <a class="btn_remove_image" title="Xoá">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="image-box-actions">
                <a id="" data-input="body-image"
                   class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i> {{ __('admin::messages.common.form.chooseImage') }}
                </a>
            </div>
        </div>
    </div>
</div>
