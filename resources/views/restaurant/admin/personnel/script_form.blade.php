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

        $('.position_id').select2({
            placeholder: "{{ __('messages.admin.personnel.table.position') }}"
        });
        $('.province_id').select2({
            placeholder: "{{ __('messages.admin.personnel.form.province') }}"
        });
        $('.district_id').select2({
            placeholder: "{{ __('messages.admin.personnel.form.district') }}"
        });
        $('.commune_id').select2({
            placeholder: "{{ __('messages.admin.personnel.form.commune') }}"
        });
        $('.bank').select2({
            placeholder: "{{ __('messages.admin.personnel.form.bank') }}"
        });
        $('.shift_id').select2({
            placeholder: "{{ __('messages.admin.shift.title') }}"
        });
        $('.work_type').select2({
            placeholder: "{{ __('messages.admin.position.table.work_type') }}"
        });

        $(document).on("change", "select[name='position_id']", function() {
            $(this).valid();
            let position_id = $(this).val();
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: `{{ route('restaurant.personnel.showPosition') }}`, 
                data: {
                    position_id: position_id,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    $("select[name='work_type']").prop('disabled', false);
                    $("select[name='shift_id']").prop('disabled', false);
                    $("select[name='work_type']").html('');
                    let type = [`{{__('messages.admin.position.part')}}`, `{{__('messages.admin.position.full')}}`]
                    $.each(response.work_types, function(key, value) {
                        $("select[name='work_type']").append(
                            "<option value=" + value + ">" + type[value] + "</option>",
                        );
                    });
                    $("select[name='shift_id']").html('');
                    $.each(response.shifts, function(key, value) {
                        $("select[name='shift_id']").append(
                            "<option value=" + value.id + ">" + "Ca " + value.name + " (Từ " + value.start + " đến " + value.end + ")" +"</option>",
                        );
                    });
                },
            })
        });

        $(document).on("change", "select[name='work_type']", function() {
            $(this).valid();
            let work_type = $(this).val();
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: `{{ route('restaurant.personnel.showShift') }}`, 
                data: {
                    work_type: work_type,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    $("select[name='shift_id']").prop('disabled', false);
                    $("select[name='shift_id']").html('');
                    $.each(response, function(key, value) {
                        $("select[name='shift_id']").append(
                            "<option value=" + value.id + ">" + "Ca " + value.name + " (Từ " + value.start + " đến " + value.end + ")" +"</option>",
                        );
                    });
                },
            })
        });

        $(document).on("change", "select[name='province_id']", function() {
            $(this).valid();
            let province_id = $(this).val();
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: `{{ route('restaurant.personnel.showDistrict') }}`, 
                data: {
                    province_id: province_id,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    $("select[name='district_id']").prop('disabled', false);
                    $("select[name='commune_id']").prop('disabled', false);
                    $("select[name='district_id']").html('');
                    $.each(response.districts, function(key, value) {
                        $("select[name='district_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>",
                        );
                    });
                    $("select[name='commune_id']").html('');
                    $.each(response.communes, function(key, value) {
                        $("select[name='commune_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>",
                        );
                    });
                },
            })
        });

        $(document).on("change", "select[name='district_id']", function() {
            $(this).valid();
            let district_id = $(this).val();
            let token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: `{{ route('restaurant.personnel.showCommune') }}`, 
                data: {
                    district_id: district_id,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    $("select[name='commune_id']").prop('disabled', false);
                    $("select[name='commune_id']").html('');
                    $.each(response, function(key, value) {
                        $("select[name='commune_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>",
                        );
                    });
                },
            })
        });

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
                "password" : {
                    minlength: 6,
                },
                "phone": {
                    required: true,
                    regex: true,
                    minlength: 10,
                    maxlength: 11,
                },
                "position_id": {
                    required: true,
                },
                "birthday": {
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
                "password" : {
                    minlength: "{{ __('validation.form.input_min', ['attribute' => __('messages.admin.personnel.form.password'), 'min' => '6'] ) }}"
                },
                "phone": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                    minlength: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                    maxlength: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.phone') ] ) }}",
                },
                "position_id": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.position') ] ) }}",
                },
                "birthday": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.form.birthday') ] ) }}",
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