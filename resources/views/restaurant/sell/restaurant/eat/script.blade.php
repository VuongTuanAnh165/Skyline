<script>
    $(document).ready(function() {
        $(document).on('click', '.create-order', function() {
            let url = $(this).data('url');
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        window.location.href = response.url;
                    } else {
                        toastr.error('Tạo hóa đơn thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Tạo hóa đơn thất bại', {
                        timeOut: 5000
                    });
                }
            });
        })
    })
</script>