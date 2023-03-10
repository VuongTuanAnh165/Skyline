<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        }
        $(document).on('click', '.btn-check-email', function() {
            let email_service = $('#email_service').val();
            $.ajax({
                url: `{{route('ceo.hire.checkEmail')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'email': email_service
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 200) {
                        $('.response-check-email').addClass('success-check-email');
                        $('.response-check-email').html('Email thỏa mãn');
                    }
                },
                error: function(xhr) {
                    $('.response-check-email').addClass('error-check-email');
                    $('.response-check-email').html(xhr.responseJSON.errors.email)
                    $('.btn-check-email').prop('disabled', true);
                }
            });
        })

        $('#email_service').on('keyup', function() {
            $('.response-check-email').removeClass('success-check-email');
            $('.response-check-email').removeClass('error-check-email');
            $('.response-check-email').text('Đăng ký email acount của bạn ngay hôm nay trước khi ai đó lấy nó.');
            $('.btn-check-email').prop('disabled', false);
        });

        $('#email_service').on('change', function() {
            $('.response-check-email').removeClass('success-check-email');
            $('.response-check-email').removeClass('error-check-email');
            $('.response-check-email').text('Đăng ký email acount của bạn ngay hôm nay trước khi ai đó lấy nó.');
            $('.btn-check-email').prop('disabled', false);
        });
    })
</script>