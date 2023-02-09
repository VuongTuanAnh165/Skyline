<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        };

        $(document).on('click','.btn-modal-form', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-service_group').text("{{  __('messages.admin.service_group.edit.title') }}")
                $.ajax({
                    url: `{{route('admin.service_group.show')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('#modalFormservice_group').find('#name').val(response.service_group.name);
                        if(response.image !== '') {
                            $('#modalFormservice_group').find('#blah').attr('src', response.image);
                        }
                    },
                    error: function(xhr) {
                        
                    }
                })
            } else {
                $('#modalFormservice_group').find('#name').val('');
                $('#modalFormservice_group').find('#blah').attr('src', `{{asset('img/default_logo.png')}}`);
                $('.title-form-service_group').text("{{  __('messages.admin.service_group.create.title') }}")
            }
            $('#btn-submit-service_group').attr('data-url', url);
            $('#btn-submit-service_group').attr('data-id', id);
        });
        $('#btn-submit-service_group').on('click', function() {
            let token = $("input[name='_token']").val();
            let id = $(this).data('id');
            let url = $(this).data('url');
            var formData = new FormData();
            var file = $('#imgInp').prop('files')[0];
            formData.append('image', file);
            formData.append('name', $('#name').val());
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType : false,
                processData : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if (response.code == 200) {
                        $('#modalFormservice_group').modal('hide');
                        if(!alert('Cập nhật thành công! Ấn OK để tiếp tục')){window.location.reload();}
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    if(xhr.responseJSON.errors.name){
                        $("input[name='name']").after(`<div class="error error-be">`+xhr.responseJSON.errors.name+`</div>`);
                        $('#btn-submit-service_group').addClass('disabledbutton')
                    }
                }
            })
        });

        $('.check').on('keyup', function() {
            $('#btn-submit-service_group').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-submit-service_group').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>