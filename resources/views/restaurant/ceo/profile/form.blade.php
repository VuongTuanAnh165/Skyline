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
                            <input disabled type="text" id="name" name="name" placeholder="{{  __('messages.admin.personnel.table.name') }}" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '') }}" class="form-control">
                            @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cmnd">Số chứng minh thư</label>
                            <input disabled type="text" id="cmnd" name="cmnd" placeholder="Số chứng minh thư" value="{{ old('cmnd') ? old('cmnd') : (isset($data->cmnd) ? $data->cmnd : '') }}" class="form-control">
                            @if ($errors->first('cmnd'))
                            <div class="error error-be">{{ $errors->first('cmnd') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">{{ __('messages.admin.personnel.table.email') }}</label>
                            <input disabled type="email" id="email" name="email" placeholder="{{  __('messages.admin.personnel.table.email') }}" value="{{ old('email') ? old('email') : (isset($data->email) ? $data->email : '') }}" class="form-control">
                            @if ($errors->first('email'))
                            <div class="error error-be">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('messages.admin.personnel.table.phone') }}</label>
                            <input disabled type="text" id="phone" name="phone" placeholder="{{  __('messages.admin.personnel.table.phone') }}" value="{{ old('phone') ? old('phone') : (isset($data->phone) ? $data->phone : '') }}" class="form-control">
                            @if ($errors->first('phone'))
                            <div class="error error-be">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-avatar">
                            <label for="avatar" class="control-label">Avatar</label>
                            <div class="upload-avatar">
                                <input disabled class="up-avatar" accept="image/*" type="file" id="imgInp" name="avatar" data-msg-accept="{{ __('validation.form.image') }}" />
                                <img id="blah" src="{{ isset($data) ? asset('storage/'.$data->avatar) : '' }}" class="avatar-personnel" onerror="this.onerror=null;this.src='{{ asset('img/avatar_default.png') }}';">
                            </div>
                            @if ($errors->first('avatar'))
                            <div class="error error-commit">{{ $errors->first('avatar') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">{{ __('messages.admin.personnel.form.address') }}</label>
                            <input disabled type="text" id="address" name="address" placeholder="{{  __('messages.admin.personnel.form.address') }}" value="{{ old('address') ? old('address') : (isset($data->address) ? $data->address : '') }}" class="form-control">
                            @if ($errors->first('address'))
                            <div class="error error-be">{{ $errors->first('address') }}</div>
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
        <div class="btn btn-primary btn-edit">Chỉnh sửa</div>
        <button type="submit" class="btn btn-success">{{ __('messages.admin.form.save') }}</button>
        <a href="{{route('ceo.profile.show')}}" class="btn btn-warning">Đặt lại</a>
        <div style="margin-top: 10px;" data-toggle="modal" data-target="#modalChangePassword" class="btn bg-gradient-dark btn-sm">
            <i class="fas fa-key"></i>
            {{ __('messages.admin.restaurant.changePassword') }}
        </div>
        <div class="modal fade modal-add-timekeeping" id="modalChangePassword" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('messages.admin.restaurant.changePassword') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <div class="row">
                                <div class="col-12">
                                    <label for="choose_time">{{ __('messages.admin.restaurant.password_old') }}</label>
                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <input class="input100" type="password" id="password_old" name="password_old" placeholder="{{ __('messages.admin.restaurant.password_old') }}">
                                        <span class="focus-input100"></span>
                                        <label class="label-form">
                                            <img src="{{ asset('img/password_icon.svg') }}">
                                        </label>
                                        <label class="label-eye-form" id="eye-old">
                                            <img src="{{ asset('img/eye_close.svg') }}">
                                        </label>
                                    </div>
                                    @if ($errors->first('password_old'))
                                    <div class="error error-be">{{ $errors->first('password_old') }}</div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="choose_time">{{ __('messages.admin.restaurant.password') }}</label>
                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <input class="input100" type="password" id="password" name="password" placeholder="{{ __('messages.admin.restaurant.password') }}">
                                        <span class="focus-input100"></span>
                                        <label class="label-form">
                                            <img src="{{ asset('img/password_icon.svg') }}">
                                        </label>
                                        <label class="label-eye-form" id="eye">
                                            <img src="{{ asset('img/eye_close.svg') }}">
                                        </label>
                                    </div>
                                    @if ($errors->first('password'))
                                    <div class="error error-be">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="choose_time">{{ __('messages.admin.restaurant.password_confirmation') }}</label>
                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <input class="input100" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('messages.admin.restaurant.password_confirmation') }}">
                                        <span class="focus-input100"></span>
                                        <label class="label-form">
                                            <img src="{{ asset('img/password_icon.svg') }}">
                                        </label>
                                        <label class="label-eye-form" id="eye-confirmation">
                                            <img src="{{ asset('img/eye_close.svg') }}">
                                        </label>
                                    </div>
                                    @if ($errors->first('password_confirmation'))
                                    <div class="error error-be">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="btn-change-password" class="btn btn-primary"><i class="fas fa-key"></i> {{ __('messages.admin.restaurant.changePassword') }}</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>