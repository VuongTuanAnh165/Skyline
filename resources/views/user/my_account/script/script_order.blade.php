<script>
    $(document).ready(function() {
        $(document).on('click', '.link_detail_order', function() {
            let order_id = $(this).text();
            let url_show = `{{ $url_show }}`
            $.ajax({
                url: `{{ route('user.myAcount.getOrderDetail') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: order_id,
                    url_show: url_show,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    let html = "'" + response + "'";
                    $('#modal-order-detail').html(html);
                },
                error: function(xhr) {

                }
            });
        });
    })
</script>
