<script>
    $(document).ready(function() {
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
                url: '/restaurant/personnel/change-password',
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