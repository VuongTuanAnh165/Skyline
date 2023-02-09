<div class="modal fade" id="modalFormItem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-customer" id="form-item" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title title-form-item">Thêm lựa chọn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" id="name" name="name" placeholder="Tên" value="{{ old('name') ? old('name') : '' }}" class="form-control check">
                        @if ($errors->first('name'))
                        <div class="error error-be">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="add_price">Giá cộng thêm</label>
                        <input type="number" id="add_price" name="add_price" min=0 placeholder="Giá cộng thêm" value="{{ old('add_price') ? old('add_price') : '' }}" class="form-control check">
                        @if ($errors->first('add_price'))
                        <div class="error error-be">{{ $errors->first('add_price') }}</div>
                        @endif
                    </div>

                    @if($service_type->service_id != 1)
                    <div class="form-group form-logo">
                        <label for="image" class="control-label">Ảnh đính kèm</label>
                        <div class="upload-logo">
                            <input class="up-logo check" value="" accept="image/*" type="file" id="imgInp" name="image" data-msg-accept="{{ __('validation.form.image') }}" />
                            <img id="blah" src="" class="image-restaurant check">
                        </div>
                        @if ($errors->first('image'))
                        <div class="error error-commit">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <div id="btn-submit-item" data-id="" data-url="" class="btn btn-primary">{{ __('messages.admin.form.save') }}</div>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->first('amount_personnel') || $errors->first('work_type') || $errors->first('wage') || $errors->first('name'))
@section('addjs')
<script>
    // $('#modalFormitem').modal('show');
</script>
@stop
@endif