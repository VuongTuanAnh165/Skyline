<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.branch_id').select2({
            placeholder: "Chọn chi nhánh",
        });
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
                    element.parent().parent().after(error);
                    $(element).closest('.form-group').find('.error-be').focusout().hide();
                }
            }
        });

        $('#btn-choose-branch').on('click', function() {
            let branch_id = $(".branch_id").val();
            $.ajax({
                url: `{{ route('sell.post.branch') }}`,
                method: 'POST',
                data: {
                    branch_id: branch_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        window.location.replace(`{{ route('sell.home.index') }}`);
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    $(".select-branch").after(`<p class="error">Vui lòng chọn chi nhánh</p>`);
                    $('#btn-choose-branch').prop('disabled', true)
                }
            })
        });

        $('.branch_id').on('keyup', function() {
            $('#btn-choose-branch').prop('disabled', false)
            $('.error').text('');
        })

        $('.branch_id').on('change', function() {
            $('#btn-choose-branch').prop('disabled', false)
            $('.error').text('');
        })
    })
</script>