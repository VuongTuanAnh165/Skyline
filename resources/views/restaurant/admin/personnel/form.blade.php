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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">{{ __('messages.admin.personnel.table.name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{  __('messages.admin.personnel.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                            @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="birthday">{{ __('messages.admin.personnel.form.birthday') }}</label>
                            <input type="date" id="birthday" name="birthday" placeholder="{{  __('messages.admin.personnel.form.birthday') }}" value="{{ old('birthday') ? old('birthday') : (isset($data->birthday) ? $data->birthday : '') }}" class="form-control">
                            @if ($errors->first('birthday'))
                            <div class="error error-be">{{ $errors->first('birthday') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">{{ __('messages.admin.personnel.table.email') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{  __('messages.admin.personnel.table.email') }}" value="{{ old('email') ? old('email') : (isset($data->email) ? $data->email : '') }}" class="form-control">
                            @if ($errors->first('email'))
                            <div class="error error-be">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('messages.admin.personnel.table.phone') }}</label>
                            <input type="text" id="phone" name="phone" placeholder="{{  __('messages.admin.personnel.table.phone') }}" value="{{ old('phone') ? old('phone') : (isset($data->phone) ? $data->phone : '') }}" class="form-control">
                            @if ($errors->first('phone'))
                            <div class="error error-be">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            @php
                            $choose_gender = old('gender') ? old('gender') : (isset($data->gender) ? $data->gender : 0);
                            @endphp
                            <label for="gender">{{ __('messages.admin.personnel.form.gender') }}</label><br>
                            <div class="icheck-primary d-inline gender-radio">
                                <input type="radio" id="gender_boy" name="gender" value="{{ $genders['boy'] }}" {{ ($genders['boy']==$choose_gender) ? 'checked' : '' }}>
                                <label for="gender_boy">{{ __('messages.admin.personnel.form.gender_boy') }}</label>
                            </div>
                            <div class="icheck-primary d-inline gender-radio">
                                <input type="radio" id="gender_girl" name="gender" value="{{ $genders['girl'] }}" {{ ($genders['girl']==$choose_gender) ? 'checked' : '' }}>
                                <label for="gender_girl">{{ __('messages.admin.personnel.form.gender_girl') }}</label>
                            </div>
                            @if ($errors->first('gender'))
                            <div class="error error-be">{{ $errors->first('gender') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-avatar">
                            <label for="avatar" class="control-label">Avatar</label>
                            <div class="upload-avatar">
                                <input class="up-avatar" accept="image/*" type="file" id="imgInp" name="avatar" data-msg-accept="{{ __('validation.form.image') }}" />
                                <img id="blah" src="{{ isset($data) ? asset('storage/'.$data->avatar) : '' }}" class="avatar-personnel" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';">
                            </div>
                            @if ($errors->first('avatar'))
                            <div class="error error-commit">{{ $errors->first('avatar') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_position = old('position_id') ? old('position_id') : (isset($data->position_id) ? $data->position_id : '');
                            @endphp
                            <label for="position_id">{{ __('messages.admin.personnel.table.position') }}</label>
                            <select {{ Auth::guard('personnel')->user() ? 'disabled' : ''}} class="form-control select2 position_id" id="position_id" name="position_id">
                                <option value="">{{ __('messages.admin.personnel.table.position') }}</option>
                                @foreach($positions as $position)
                                <option value="{{ $position->id }}" @if($choose_position==$position->id) selected @endif>{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('position_id'))
                            <div class="error error-be">{{ $errors->first('position_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_work_type = old('work_type') ? old('work_type') : (isset($data->work_type) ? $data->work_type : '');
                            @endphp
                            <label for="work_type">{{ __('messages.admin.position.table.work_type') }}</label>
                            <select class="form-control select2 work_type" name="work_type" disabled>
                                <option value="">{{ __('messages.admin.position.table.work_type') }}</option>
                                @if($choose_work_type !== "")
                                <option value="{{ $choose_work_type }}" selected>{{ $choose_work_type == '1' ? __('messages.admin.position.full') : __('messages.admin.position.part') }}</option>
                                @endif
                            </select>
                            @if ($errors->first('work_type'))
                            <div class="error error-be">{{ $errors->first('work_type') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_shift = old('shift_id') ? old('shift_id') : (isset($data->shift_id) ? $data->shift_id : '');
                            if(!empty($choose_shift)) {
                            $shift = \App\Models\Shift::select('id', 'name')->where('id', $choose_shift)->first();
                            }
                            @endphp
                            <label for="shift_id">{{ __('messages.admin.shift.title') }}</label>
                            <select class="form-control select2 shift_id" name="shift_id" disabled>
                                <option value="">{{ __('messages.admin.shift.title') }}</option>
                                @if(!empty($choose_shift))
                                <option value="{{ $shift->id }}" selected>Ca {{ $shift->name }}</option>
                                @endif
                            </select>
                            @if ($errors->first('shift_id'))
                            <div class="error error-be">{{ $errors->first('shift_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_province = old('province_id') ? old('province_id') : (isset($data->province_id) ? $data->province_id : '');
                            @endphp
                            <label for="">{{ __('messages.admin.personnel.table.hometown') }}</label>
                            <select class="form-control select2 province_id" name="province_id">
                                <option value="">{{ __('messages.admin.personnel.form.province') }}</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}" @if($choose_province==$province->id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('province_id'))
                            <div class="error error-be">{{ $errors->first('province_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_district = old('district_id') ? old('district_id') : (isset($data->district_id) ? $data->district_id : '');
                            if(!empty($choose_district)) {
                            $district = \App\Models\District::select('id', 'name')->where('id', $choose_district)->first();
                            }
                            @endphp
                            <label for=""><br></label>
                            <select class="form-control select2 district_id" name="district_id" disabled>
                                <option value="">{{ __('messages.admin.personnel.form.district') }}</option>
                                @if(!empty($district))
                                <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                                @endif
                            </select>
                            @if ($errors->first('district_id'))
                            <div class="error error-be">{{ $errors->first('district_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $choose_commune = old('commune_id') ? old('commune_id') : (isset($data->commune_id) ? $data->commune_id : '');
                            if(!empty($choose_commune)) {
                            $commune = \App\Models\Commune::select('id', 'name')->where('id', $choose_commune)->first();
                            }
                            @endphp
                            <label for=""><br></label>
                            <select class="form-control select2 commune_id" name="commune_id" disabled>
                                <option value="">{{ __('messages.admin.personnel.form.commune') }}</option>
                                @if(!empty($commune))
                                <option value="{{ $commune->id }}" selected>{{ $commune->name }}</option>
                                @endif
                            </select>
                            @if ($errors->first('commune_id'))
                            <div class="error error-be">{{ $errors->first('commune_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">{{ __('messages.admin.personnel.form.address') }}</label>
                            <input type="text" id="address" name="address" placeholder="{{  __('messages.admin.personnel.form.address') }}" value="{{ old('address') ? old('address') : (isset($data->address) ? $data->address : '') }}" class="form-control">
                            @if ($errors->first('address'))
                            <div class="error error-be">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            @php
                            $choose_bank = old('bank_id') ? old('bank_id') : (isset($data->bank_id) ? $data->bank_id : '');
                            @endphp
                            <label for="bank_id">{{ __('messages.admin.personnel.form.bank') }}</label>
                            <select class="form-control select2 bank" name="bank_id">
                                <option value="">{{ __('messages.admin.personnel.form.bank') }}</option>
                                @foreach($banks as $bank)
                                <option value="{{ $bank->id }}" @if($choose_bank==$bank->id) selected @endif>
                                    {{ $bank->shortName . ' (' . $bank->name .')' }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->first('bank'))
                            <div class="error error-be">{{ $errors->first('bank') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_number">{{ __('messages.admin.personnel.form.account_number') }}</label>
                            <input type="text" name="account_number" placeholder="{{  __('messages.admin.personnel.form.account_number') }}" value="{{ old('account_number') ? old('account_number') : (isset($data->account_number) ? $data->account_number : '') }}" class="form-control">
                            @if ($errors->first('account_number'))
                            <div class="error error-be">{{ $errors->first('account_number') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="signed_at">{{ __('messages.admin.personnel.form.signed_at') }}</label>
                            <input {{ Auth::guard('personnel')->user() ? 'disabled' : ''}} type="date" name="signed_at" placeholder="{{  __('messages.admin.personnel.form.signed_at') }}" value="{{ old('signed_at') ? old('signed_at') : (isset($data->signed_at) ? $data->signed_at : '') }}" class="form-control">
                            @if ($errors->first('signed_at'))
                            <div class="error error-be">{{ $errors->first('signed_at') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="started_at">{{ __('messages.admin.personnel.form.started_at') }}</label>
                            <input {{ Auth::guard('personnel')->user() ? 'disabled' : ''}} type="date" name="started_at" placeholder="{{  __('messages.admin.personnel.form.started_at') }}" value="{{ old('started_at') ? old('started_at') : (isset($data->started_at) ? $data->started_at : '') }}" class="form-control">
                            @if ($errors->first('started_at'))
                            <div class="error error-be">{{ $errors->first('started_at') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ended_at">{{ __('messages.admin.personnel.form.ended_at') }}</label>
                            <input {{ Auth::guard('personnel')->user() ? 'disabled' : ''}} type="date" name="ended_at" placeholder="{{  __('messages.admin.personnel.form.ended_at') }}" value="{{ old('ended_at') ? old('ended_at') : (isset($data->ended_at) ? $data->ended_at : '') }}" class="form-control">
                            @if ($errors->first('ended_at'))
                            <div class="error error-be">{{ $errors->first('ended_at') }}</div>
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