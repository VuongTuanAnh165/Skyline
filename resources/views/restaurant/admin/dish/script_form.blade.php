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
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        };
        $('.category_id').select2({
            placeholder: "{{ $messages['dish']['table']['category'] }}"
        });
        $('.branch_id').select2({
            placeholder: "Chọn chi nhánh"
        });
        $('.category_home_id').select2({
            placeholder: "{{ $messages['dish']['table']['category_home'] }}"
        });
        $('#summernote').summernote({
            placeholder: "{{ __('messages.admin.restaurant.form.content') }}",
            tabsize: 2,
            height: 250,
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
    })
</script>