<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.service_id').select2({
            placeholder: "Dịch vụ"
        });
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        };

        $(document).on('click','.btn-modal-form','click', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-category').text("{{  __('messages.admin.category_home.edit.title') }}")
                $.ajax({
                    url: `{{route('admin.category.show')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('#modalFormCategory').find('#name').val(response.category.name);
                        if(response.image !== '') {
                            $('#modalFormCategory').find('#blah').attr('src', response.image);
                        }
                        $('#modalFormCategory').find("#service_id").val(response.category.service_id).change();
                    },
                    error: function(xhr) {
                        
                    }
                })
            } else {
                $('#modalFormCategory').find('#name').val('');
                $('#modalFormCategory').find('#blah').attr('src', `{{asset('img/default_logo.png')}}`);
                $('.title-form-category').text("{{  __('messages.admin.category_home.create.title') }}")
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
            formData.append('name', $('#name').val());
            formData.append('service_id', $('#service_id').val());
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
                        $('#modalFormCategory').modal('hide');
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
                        $('#btn-submit-category').addClass('disabledbutton')
                    }
                }
            })
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