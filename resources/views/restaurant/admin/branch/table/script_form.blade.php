<!-- Select2 -->
<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        $(document).on('click', '.btn-modal-form', 'click', function() {
            $(".error.error-be").text('');
            let id = $(this).data('id');
            let url = $(this).data('url');
            if (id) {
                $('.title-form-table').text("Chỉnh sửa bàn ăn")
                $.ajax({
                    url: `{{route('restaurant.table.show')}}`,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('#modalFormTable').find('#name_show').val(response.table.name);
                        $('#modalFormTable').find('#name').val(response.table.name);
                        $('#modalFormTable').find('#max_people').val(response.table.max_people);
                    },
                    error: function(xhr) {

                    }
                })
            } else {
                $('#modalFormTable').find('#name_show').val(`{{$name}}`);
                $('#modalFormTable').find('#name').val(`{{$name}}`);
                $('#modalFormTable').find('#max_people').val('');
                $('.title-form-table').text("Thêm bàn ăn")
            }
            $('#btn-submit-table').attr('data-url', url);
            $('#btn-submit-table').attr('data-id', id);
        });
        $('#btn-submit-table').on('click', function() {
            let token = $("input[name='_token']").val();
            let id = $(this).data('id');
            let url = $(this).data('url');
            let name = $("input[name='name']").val();
            let max_people = $("input[name='max_people']").val()
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    name: name,
                    max_people: max_people,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#modalFormTable').modal('hide');
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
                        $('#btn-submit-table').addClass('disabledbutton')
                    }
                    if (xhr.responseJSON.errors.max_people) {
                        $("input[name='max_people']").after(`<div class="error error-be">` + xhr.responseJSON.errors.max_people + `</div>`);
                        $('#btn-submit-table').addClass('disabledbutton')
                    }
                }
            })
        });

        $('.check').on('keyup', function() {
            $('#btn-submit-table').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-submit-table').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>