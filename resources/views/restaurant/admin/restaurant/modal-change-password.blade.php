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
                <div class="modal-body">
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