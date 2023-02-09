<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, "{{ __('validation.form.file_size', ['max_value'=>'2 MB']) }}");

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
                    regex: true,
                },
                "address": {
                    required: true,
                },
                "open_time": {
                    required: true,
                },
                "close_time": {
                    required: true,
                },
            },
            messages: {
                "name": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.branch.form.name') ] ) }}",
                },
                "address": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.branch.table.address') ] ) }}",
                },
                "open_time": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.branch.table.open_time') ] ) }}",
                },
                "close_time": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.branch.table.close_time') ] ) }}",
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

        function disabledbutton() {
            if ($('.file-row-old').length == 1) {
                let btn_delete = $('.file-row-old').find('.delete');
                btn_delete.addClass("disabledbutton");
            } else {
                let btn_delete = $('.disabledbutton');
                btn_delete.removeClass("disabledbutton");
            }
        };

        function disableCreateDelete() {
            if ($('.file-row').length == 1) {
                let btn_delete = $('.file-row').find('.delete');
                btn_delete.addClass("disabledbutton");
            } else {
                let btn_delete = $('.disabledbutton');
                btn_delete.removeClass("disabledbutton");
            }
        }

        disabledbutton();

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone("#upfile", { // Make the whole body a dropzone
            url: "#",
            maxFilesize: 2,
            thumbnailMethod: "crop",
            paramName: "background",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 20,
            previewTemplate: previewTemplate,
            autoQueue: false,
            previewsContainer: "#previews",
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            var filePreview = file.previewTemplate
            var fd = new FormData();
            fd.append('background', file);
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                url: '/restaurant/branch/upload',
                cache: false,
                type: 'POST',
                data: fd,
                processData: false, ///required to upload file
                contentType: false, /// required
                success: function(response) {
                    $(filePreview).find("input").val(response.success);
                    disableCreateDelete();
                }
            })
        })

        $(document).on("click", ".delete", function() {
            var $ele = $(this).parent().parent().parent();
            var file_name = $(this).closest('.file-row').find('input').val();
            $.ajax({
                url: '/restaurant/branch/remove',
                cache: false,
                type: 'GET',
                data: {
                    'file_name': file_name
                },
                success: function(response) {
                    if (response.status == 200) {
                        $ele.fadeOut().remove();
                        disableCreateDelete();
                    }
                }
            })
        });
    })
</script>