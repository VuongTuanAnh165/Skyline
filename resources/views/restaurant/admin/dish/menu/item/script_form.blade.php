<!-- Select2 -->
<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        if ($('#modalFormItem').find('#blah').length > 0) {
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            };
        }

        $(document).on('click', '.btn-modal-form', 'click', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-item').text("Chỉnh sửa lựa chọn")
                $.ajax({
                    url: `{{route('restaurant.menu.itemShow')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('#modalFormItem').find('#name').val(response.item.name);
                        $('#modalFormItem').find('#add_price').val(response.item.add_price);
                        if ($('#modalFormItem').find('#blah').length > 0) {
                            if (response.image !== '') {
                                $('#modalFormItem').find('#blah').attr('src', response.image);
                            } else {
                                $('#modalFormItem').find('#blah').attr('src', `{{asset('img/background_default.jpg')}}`);
                            }
                        }
                    },
                    error: function(xhr) {

                    }
                })
            } else {
                $('#modalFormItem').find('#name').val('');
                $('#modalFormItem').find('#add_price').val('');
                if ($('#modalFormItem').find('#blah').length > 0) {
                    $('#modalFormItem').find('#blah').attr('src', `{{asset('img/background_default.jpg')}}`);
                }
                $('.title-form-item').text("Thêm lựa chọn")
            }
            $('#btn-submit-item').attr('data-url', url);
            $('#btn-submit-item').attr('data-id', id);
        });
        $('#btn-submit-item').on('click', function() {
            let token = $("input[name='_token']").val();
            let id = $(this).data('id');
            let url = $(this).data('url');
            var formData = new FormData();
            if ($('#modalFormItem').find('#blah').length > 0) {
                var file = $('#imgInp').prop('files')[0];
                formData.append('image', file);
            }
            formData.append('name', $("input[name='name']").val());
            formData.append('add_price', $("input[name='add_price']").val());
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
                        $('#modalFormItem').modal('hide');
                        if (!alert('Cập nhật thành công! Ấn OK để tiếp tục')) {
                            window.location.reload();
                        }
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON.errors.name) {
                        $("input[name='name']").after(`<div class="error error-be">` + xhr.responseJSON.errors.name + `</div>`);
                        $('#btn-submit-item').addClass('disabledbutton')
                    }
                    if (xhr.responseJSON.errors.add_price) {
                        $("input[name='add_price']").after(`<div class="error error-be">` + xhr.responseJSON.errors.add_price + `</div>`);
                        $('#btn-submit-item').addClass('disabledbutton')
                    }
                }
            })
        });

        $('.check').on('keyup', function() {
            $('#btn-submit-item').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-submit-item').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>