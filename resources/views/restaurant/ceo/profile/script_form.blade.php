<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        };

        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        jQuery.validator.addMethod("regex", function(value, element) {
            var regex = /^[0-9]+$/;
            return regex.test(value);
        }, "Yêu cầu nhập đúng định dạng số");

        $(".form-customer").validate({
            onfocusout: function(element, event) {
                $(element).valid();
            },
            submitHandler: function(form) {
                form.submit();
            },
            showErrors: function(errorMap, errorList) {
                var errorForm = this.numberOfInvalids();
                if (errorForm >= 1) {
                    $("form button[type='submit']").attr("disabled", true);
                } else {
                    $("form button[type='submit']").attr("disabled", false);
                }
                var $errorDiv = $("#errordiv").empty().show();
                this.defaultShowErrors();
                var errorsCombined = "";
                for (var el in errorMap) {
                    errorsCombined += "<b>" + el + "</b>" + errorMap[el] + "<br/>";
                }
                $errorDiv.append(errorsCombined);
            },
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {

                }
            },

            rules: {
                "name": {
                    required: true,
                },
                "email" : {
                    required: true,
                    email: true,
                },
                "phone": {
                    required: true,
                    regex: true,
                    minlength: 10,
                    maxlength: 11,
                },
                "cmnd": {
                    required: true,
                    regex: true,
                },
                "adress": {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.name') ] ) }}",
                },
                "email": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.email') ] ) }}",
                    email: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.email') ] ) }}",
                },
                "phone": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                    minlength: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                    maxlength: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                },
                "cmnd": {
                    required: "{{ __('validation.form.input_required', ['attribute' => 'Số chứng minh thư' ] ) }}",
                },
                "adress": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.form.adress') ] ) }}",
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    element.parent().after(error);
                    $(element).closest('.form-group').find('.error-be').focusout().hide();
                }
            }
        });

        function edit() {
            $('input').prop('disabled', false);
        }
        $('.btn-edit').on('click', function () {
            edit();
        });

        $('#eye').click(function() {
            let image = $(this).children();
            let input = $(this).prev().prev().prev();
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            image.attr('src', image.attr('src') === `{{ asset('img/eye_close.svg') }}` ? `{{ asset('img/eye_open.svg') }}` : `{{ asset('img/eye_close.svg') }}`);
        });

        $('#eye-old').click(function() {
            let image = $(this).children();
            let input = $(this).prev().prev().prev();
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            image.attr('src', image.attr('src') === `{{ asset('img/eye_close.svg') }}` ? `{{ asset('img/eye_open.svg') }}` : `{{ asset('img/eye_close.svg') }}`);
        });

        $('#eye-confirmation').click(function() {
            let image = $(this).children();
            let input = $(this).prev().prev().prev();
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            image.attr('src', image.attr('src') === `{{ asset('img/eye_close.svg') }}` ? `{{ asset('img/eye_open.svg') }}` : `{{ asset('img/eye_close.svg') }}`);
        });

        $(document).on("click", "#btn-change-password", function() {
            let password = $("input[name='password']").val();
            let password_old = $("input[name='password_old']").val();
            let password_confirmation = $("input[name='password_confirmation']").val();
            $.ajax({
                url: `{{route('ceo.profile.changePassword')}}`,
                cache: false,
                headers: {
                    'X-CSRF-Token': $('#modalChangePassword').find('input[name="_token"]').val()
                },
                type: 'POST',
                data: {
                    'password': password,
                    'password_old': password_old,
                    'password_confirmation': password_confirmation,
                },
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success('Đổi mật khẩu thành công', {
                            timeOut: 5000
                        });
                        $("input[name='password']").val('');
                        $("input[name='password_old']").val('');
                        $("input[name='password_confirmation']").val('');
                        $('#modalChangePassword').modal('hide');
                    } else {
                        toastr.error('Đổi mật khẩu thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function (xhr) {
                    let txt_error = "";
                    if(xhr.responseJSON.errors.password_old) {
                        txt_error = xhr.responseJSON.errors.password_old
                    } else if(xhr.responseJSON.errors.password) {
                        txt_error = xhr.responseJSON.errors.password;
                    } else {
                        txt_error = xhr.responseJSON.errors.password_confirmation;
                    }
                    toastr.error(txt_error, {
                        timeOut: 5000
                    });
                }
            })
        });
    })
</script>