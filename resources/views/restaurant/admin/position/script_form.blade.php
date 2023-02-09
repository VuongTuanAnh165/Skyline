<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        $('.work_type_form').select2({
            placeholder: "{{ __('messages.admin.position.table.work_type') }}"
        });

        $(document).on('click','.btn-modal-form','click', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-position').text("{{  __('messages.admin.position.edit.title') }}")
                $.ajax({
                    url: `{{route('restaurant.position.show')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('#modalFormPosition').find('#name').val(response.position.name);
                        $('#modalFormPosition').find('#wage').val(response.position.wage);
                        $('#modalFormPosition').find('#amount_personnel').val(response.position.amount_personnel);
                        $("select[name='work_type[]']").val(response.position.work_type).change();
                    },
                    error: function(xhr) {

                    }
                })
            } else {
                $('#modalFormPosition').find('#name').val('');
                $('#modalFormPosition').find('#wage').val('');
                $('#modalFormPosition').find('#amount_personnel').val('');
                $("select[name='work_type[]']").val('').change();
                $('.title-form-position').text("{{  __('messages.admin.position.create.title') }}")
            }
            $('#btn-submit-position').attr('data-url', url);
            $('#btn-submit-position').attr('data-id', id);
        });
        $('#btn-submit-position').on('click', function() {
            let token = $("input[name='_token']").val();
            let id = $(this).data('id');
            let url = $(this).data('url');
            let name = $("input[name='name']").val();
            let wage = $("input[name='wage']").val();
            let work_type = $("select[name='work_type[]']").val();
            let amount_personnel = $("input[name='amount_personnel']").val();
            $.ajax({
                type: "GET",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: name,
                    wage: wage,
                    work_type: work_type,
                    amount_personnel: amount_personnel,
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#modalFormPosition').modal('hide');
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
                        $('#btn-submit-position').addClass('disabledbutton')
                    }
                    if(xhr.responseJSON.errors.wage){
                        $("input[name='wage']").after(`<div class="error error-be">`+xhr.responseJSON.errors.wage+`</div>`);
                        $('#btn-submit-position').addClass('disabledbutton')
                    }
                    if(xhr.responseJSON.errors.work_type){
                        $("select[name='work_type[]']").after(`<div class="error error-be">`+xhr.responseJSON.errors.work_type+`</div>`);
                        $('#btn-submit-position').addClass('disabledbutton')
                    }
                    if(xhr.responseJSON.errors.amount_personnel){
                        $("input[name='amount_personnel']").after(`<div class="error error-be">`+xhr.responseJSON.errors.amount_personnel+`</div>`);
                        $('#btn-submit-position').addClass('disabledbutton')
                    }
                }
            })
        });

        $('.check').on('keyup', function() {
            $('#btn-submit-position').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-submit-position').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>