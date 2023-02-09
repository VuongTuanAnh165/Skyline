<script>
    $(document).ready(function() {
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
                "email": {
                    required: true,
                    email: true,
                },
                "password": {
                    required: true,
                },
            },
            messages: {
                "email": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.login.email') ] ) }}",
                    email: "{{ __('validation.form.ip_regex', ['attribute' => __('messages.admin.login.email') ] ) }}",
                },
                "password": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.login.password') ] ) }}",
                },
            },
            errorElement: 'p',
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
    })
</script>