<div class="modal fade" id="modalFormTable" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-customer" id="form-table" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title title-form-table">Thêm bàn ăn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Bàn số</label>
                        <input type="number" id="name_show" placeholder="Bàn số" value="{{ isset($name) ? $name : (isset($data->name) ? $data->name : '') }}" disabled class="form-control">
                        <input type="hidden" id="name" name="name" placeholder="Bàn số" value="{{ isset($name) ? $name : (isset($data->name) ? $data->name : '') }}" class="form-control">
                        @if ($errors->first('name'))
                        <div class="error error-be">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="max_people">Số người tối đa</label>
                        <input type="number" id="max_people" name="max_people" min=0 placeholder="Số người tối đa" value="{{ old('max_people') ? old('max_people') : '' }}" class="form-control check">
                        @if ($errors->first('max_people'))
                        <div class="error error-be">{{ $errors->first('max_people') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btn-submit-table" data-id="" data-url="" class="btn btn-primary">{{ __('messages.admin.form.save') }}</div>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->first('amount_personnel') || $errors->first('work_type') || $errors->first('wage') || $errors->first('name'))
@section('addjs')
<script>
    // $('#modalFormtable').modal('show');
</script>
@stop
@endif