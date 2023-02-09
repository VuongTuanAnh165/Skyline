<!-- Summernote -->
<script src="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('template_web_admin/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<script>
    $(document).ready(function() {
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

        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })

        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

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
                    minlength: 3,
                    maxlength: 150,
                },
                "email": {
                    required: true,
                    email: true,
                },
                "phone": {
                    required: true,
                },
                "logo": {
                    filesize: 2097152,
                },
            },
            messages: {
                "name": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.restaurant.form.name') ] ) }}",
                    minlength: "{{ __('validation.form.input_min', ['attribute' => __('messages.admin.restaurant.form.name'), 'min' => '3' ] ) }}",
                    maxlength: "{{ __('validation.form.input_max', ['attribute' => __('messages.admin.restaurant.form.name'), 'max' => '150' ] ) }}",
                },
                "email": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.personnel.table.email') ] ) }}",
                    email: "{{ __('validation.form.input_regex', ['attribute' => __('messages.admin.personnel.table.email') ] ) }}",
                },
                "phone": {
                    required: "{{ __('validation.form.input_required', ['attribute' => __('messages.admin.restaurant.form.phone') ] ) }}",
                },
                "logo": {
                    extension: "{{ __('validation.form.image ') }}",
                    filesize: "{{ __('validation.form.file_size', ['max_value'=>'2 MB']) }}",
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

        $('#summernote').summernote({
            placeholder: "{{ __('messages.admin.restaurant.form.content') }}",
            tabsize: 2,
            height: 200,
            minHeight: 100,
            maxHeight: 300,
            focus: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['fontsizeunit', ['fontsizeunit']],
                ['color', ['color']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
            ],
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            codemirror: {
                mode: "htmlmixed",
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function(image, editor) {
                    let data = new FormData();
                    data.append('file', image[0]);
                    $.ajax({
                        url: `{{route('upload.image.summernote')}}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: data,
                        type: 'post',
                        success: function (response) {
                            if (response.status == 200) {
                                var image = $('<img>').attr('src', `{{asset('storage/')}}` + "/"+response.url);
                                $('#summernote').summernote("insertNode", image[0]);
                            }
                        }
                    });
                }
            }
        });

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
                url: '/restaurant/restaurant/upload',
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
                url: '/restaurant/restaurant/remove',
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
                url: '/restaurant/restaurant/change-password',
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