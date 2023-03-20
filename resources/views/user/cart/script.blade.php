<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        };

        function total() {
            let cart_table_body_items = $('.cart__table--body__items');
            cart_table_body_items.each(function() {
                let total = 0;
                let value_price = $(this).find('.value_price');
                value_price.each(function() {
                    total += Number($(this).val());
                });
                total = total * $(this).find('.quickview__value--number').val()
                $(this).find('.cart__price.end').text(new Intl.NumberFormat('it-IT', config).format(
                    total));
                let quantity = $(this).find('.quickview__value--number').val();
                if (quantity <= 1) {
                    $(this).find('.quickview__value--quantity.decrease').prop(
                        'disabled', true);
                } else {
                    $(this).find('.quickview__value--quantity.decrease').prop(
                        'disabled', false);
                }
            });
        };
        total();
        $(document).on('click', '.quickview__value--quantity', function() {
            let parent = $(this).closest('.cart__table--body__items');
            let quantity = parent.find('.quickview__value--number').val();
            let detail_order_log_id = parent.find('.detail_order_log_id').val();
            if (quantity >= 1) {
                $.ajax({
                    url: `{{ route('user.updateCart') }}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        quantity: quantity,
                        detail_order_log_id: detail_order_log_id,
                    },
                    cache: false,
                    method: 'POST',
                    success: function(response) {
                        if (response.code == 200) {
                            toastr.success('Cập nhật giỏ hàng thành công', {
                                timeOut: 5000
                            });
                            total();
                        } else {
                            toastr.error('Cập nhật giỏ hàng thất bại', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Cập nhật giỏ háng thất bại', {
                            timeOut: 5000
                        });
                    }
                });
            }
        });
    })
</script>
