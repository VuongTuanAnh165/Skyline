<div class="modal fade modal-add-timekeeping" id="modalAddTimekeeping" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('restaurant.personnel.check', ['id'=>$personnel->id])}}" class="form-add-timekeeping" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.admin.personnel.timekeeping.title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('messages.admin.personnel.title') }}: <strong>{{ $personnel->name }}</strong></p>
                    <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="choose_date">{{ __('messages.admin.personnel.timekeeping.form.day') }}</label>
                            <input type="date" name="choose_date" id="choose_date" placeholder="{{ __('messages.admin.personnel.timekeeping.form.day') }}" value="{{ old('choose_date') ? old('choose_date') : '' }}" class="form-control">
                            @if ($errors->first('choose_date'))
                            <div class="error error-be">{{ $errors->first('choose_date') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="choose_time">{{ __('messages.admin.personnel.timekeeping.form.hour') }}</label>
                            <input type="time" name="choose_time" id="choose_time" placeholder="{{ __('messages.admin.personnel.timekeeping.form.hour') }}" value="{{ old('choose_time') ? old('choose_time') :'' }}" class="form-control">
                            @if ($errors->first('choose_time'))
                            <div class="error error-be">{{ $errors->first('choose_time') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="far fa-calendar-check"></i> {{ __('messages.admin.table.timeKeeping') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>