<script>
    $(document).ready(function() {
        var check = 0;
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
            check = 1;
        };

        $(document).on('click', '.btn-modal-form', 'click', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-category').text("{{  __('messages.admin.image.edit.title') }}")
                $.ajax({
                    url: `{{route('admin.image.show')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.data.type == 0) {
                            $("#web_admin").prop('checked', true);
                        }
                        if (response.data.type == 1) {
                            $("#web_customer").prop('checked', true);
                        }
                        if (response.data.type == 2) {
                            $("#web_restaurant").prop('checked', true);
                        }
                        if (response.data.type == 3) {
                            $("#web_sell").prop('checked', true);
                        }
                        if (response.data.type == 4) {
                            $("#web_service").prop('checked', true);
                        }
                        if (response.data.type == 5) {
                            $("#web_user_shop").prop('checked', true);
                        }
                        if (response.data.type == 6) {
                            $("#web_user_web").prop('checked', true);
                        }
                        if (response.data.type == 7) {
                            $("#app_user_sell").prop('checked', true);
                        }
                        if (response.data.type == 8) {
                            $("#app_sell").prop('checked', true);
                        }
                        if (response.image !== '') {
                            $('#modalFormimage').find('#blah').attr('src', response.image);
                        }
                        check = 1;
                    },
                    error: function(xhr) {
                        check = 0;
                    }
                })
            } else {
                $('#modalFormimage').find('#blah').attr('src', `{{asset('img/background_default.jpg')}}`);
                $('.title-form-category').text("{{  __('messages.admin.image.create.title') }}");
                check = 0;
            }
            $('#btn-submit-category').attr('data-url', url);
            $('#btn-submit-category').attr('data-id', id);
        });
        $('#btn-submit-category').on('click', function() {
            let token = $("input[name='_token']").val();
            let id = $(this).data('id');
            let url = $(this).data('url');
            var formData = new FormData();
            var file = $('#imgInp').prop('files')[0];
            formData.append('image', file);
            formData.append('type', $("input[name='type']:checked").val());
            if (check == 1) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            $('#modalFormimage').modal('hide');
                            if (!alert('Cập nhật thành công! Ấn OK để tiếp tục')) {
                                window.location.reload();
                            }
                        } else if (response.code == 500) {
                            $(".form-logo").after(`<div class="error error-be">` + response.error + `</div>`);
                            toastr.error('Thất bại', {
                                timeOut: 5000
                            });
                            $('#btn-submit-category').addClass('disabledbutton')
                        } else {
                            toastr.error('Thất bại', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.errors.image) {
                            $(".form-logo").after(`<div class="error error-be">` + xhr.responseJSON.errors.image + `</div>`);
                            $('#btn-submit-category').addClass('disabledbutton')
                        }
                        if (xhr.responseJSON.errors.type) {
                            $(".form-type").after(`<div class="error error-be">` + xhr.responseJSON.errors.image + `</div>`);
                            $('#btn-submit-category').addClass('disabledbutton')
                        }
                    }
                })
            } else {
                $(".form-logo").after(`<div class="error error-be">Hình ảnh không được bỏ trống</div>`);
                $('#btn-submit-category').addClass('disabledbutton');
            }
        });

        $('.check').on('keyup', function() {
            $('#btn-submit-category').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-submit-category').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>