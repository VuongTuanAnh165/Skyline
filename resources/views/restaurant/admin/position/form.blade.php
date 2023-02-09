<div class="modal fade" id="modalFormPosition" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-customer" id="form-position" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title title-form-position">{{ __('messages.admin.position.create.title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('messages.admin.position.table.name') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{  __('messages.admin.position.table.name') }}" value="{{ old('name') ? old('name') : '' }}" class="form-control check">
                        @if ($errors->first('name'))
                        <div class="error error-be">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="wage">{{ __('messages.admin.position.table.wage') }}</label>
                        <input type="number" id="wage" name="wage" min=1 placeholder="{{  __('messages.admin.position.table.wage') }}" value="{{ old('wage') ? old('wage') : '' }}" class="form-control check">
                        @if ($errors->first('wage'))
                        <div class="error error-be">{{ $errors->first('wage') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        @php
                        $choose_work_type = old('work_type') ? old('work_type') : [];
                        @endphp
                        <label for="work_type">{{ __('messages.admin.position.table.work_type') }}</label>
                        <select class="form-control select2 work_type_form check" multiple="multiple" name="work_type[]">
                            <option id="full" value="{{ $full }}" @if(in_array($full, $choose_work_type)) selected @endif>{{ __('messages.admin.position.full') }}</option>
                            <option id="part" value="{{ $part }}" @if(in_array($part, $choose_work_type)) selected @endif>{{ __('messages.admin.position.part') }}</option>
                        </select>
                        @if ($errors->first('work_type'))
                        <div class="error error-be">{{ $errors->first('work_type') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="amount_personnel">{{ __('messages.admin.position.table.amount_personnel') }}</label>
                        <input type="number" id="amount_personnel" name="amount_personnel" min=1 placeholder="{{  __('messages.admin.position.table.amount_personnel') }}" value="{{ old('amount_personnel') ? old('amount_personnel') : (isset($data->amount_personnel) ? $data->amount_personnel : '') }}" class="form-control check">
                        @if ($errors->first('amount_personnel'))
                        <div class="error error-be">{{ $errors->first('amount_personnel') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btn-submit-position" data-id="" data-url="" class="btn btn-primary">{{ __('messages.admin.form.save') }}</div>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->first('amount_personnel') || $errors->first('work_type') || $errors->first('wage') || $errors->first('name'))
@section('addjs')
<script>
    // $('#modalFormPosition').modal('show');
</script>
@stop
@endif