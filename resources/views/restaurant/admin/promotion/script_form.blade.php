<script>
    $(document).ready(function() {
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
                "condition": {
                    required: true,
                },
                "value": {
                    required: true,
                },
                "started_at": {
                    required: true,
                },
                "ended_at": {
                    required: true,
                },
            },
            messages: {
                "name": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.promotion.table.name') ] ) }}",
                },
                "condition": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.promotion.table.condition') ] ) }}",
                },
                "value": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.promotion.table.value') ] ) }}",
                },
                "started_at": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.promotion.table.started_at') ] ) }}",
                },
                "ended_at": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.promotion.table.ended_at') ] ) }}",
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
    })
</script>