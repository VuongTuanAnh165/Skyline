<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('template_web_admin/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.category_id').select2({
            placeholder: "{{ $messages['dish']['table']['category'] }}"
        });
        $('.branch_id').select2({
            placeholder: "Chọn chi nhánh"
        });
        $('.menu_id').select2({
            placeholder: "Chọn menu"
        });
        $('.category_home_id').select2({
            placeholder: "{{ $messages['dish']['table']['category_home'] }}"
        });
        $('#summernote').summernote({
            placeholder: "{{ __('messages.admin.restaurant.form.content') }}",
            tabsize: 2,
            height: 350,
            minHeight: 100,
            maxHeight: 400,
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
                "category_id": {
                    required: true,
                },
                "price": {
                    required: true,
                    regex: true,
                },
            },
            messages: {
                "name": {
                    required: "{{ __('validation.form.input_required', ['attribute' => $messages['dish']['table']['name'] ] ) }}",
                },
                "category_id": {
                    required: "{{ __('validation.form.input_required', ['attribute' => $messages['dish']['table']['category'] ] ) }}",
                },
                "price": {
                    required: "{{ __('validation.form.input_required', ['attribute' => $messages['dish']['table']['price'] ] ) }}",
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

        $('#category_id').on('change', function () {
            $(this).closest('.form-group').find('.error').focusout().hide();
        })

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
            paramName: "image",
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
            fd.append('image', file);
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                url: '/restaurant/dish/image/upload',
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
                url: '/restaurant/dish/image/remove',
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