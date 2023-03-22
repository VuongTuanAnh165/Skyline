<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        };

        $(document).on('click', '.checkbox-all', function() {
            let cart_restaurant = $(this).closest('.cart-restaurant');
            if ($(this).is(":checked")) {
                cart_restaurant.find('.checkbox-one').prop('checked', true);
            } else {
                cart_restaurant.find('.checkbox-one').prop('checked', false);
            }
        });

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

        $(document).on('click', '.cart__remove--btn', function() {
            let parent = $(this).closest('.cart__table--body__items');
            let detail_order_log_id = parent.find('.detail_order_log_id');
            $.ajax({
                url: `{{ route('user.deleteOneCart') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    detail_order_log_id: detail_order_log_id.val(),
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Cập nhật giỏ hàng thành công', {
                            timeOut: 5000
                        });
                        total();
                        if (response.deleteAll == 1) {
                            parent.closest('.cart-restaurant').remove();
                        } else {
                            parent.remove();
                        }
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
        });

        $('.continue__shopping--clear').on('click', function() {
            let detail_order_log_id = [];
            let checkbox_one = $('.checkbox-one');
            checkbox_one.each(function() {
                if ($(this).is(":checked")) {
                    detail_order_log_id.push($(this).closest('.cart__table--body__items').find(
                        '.detail_order_log_id').val());
                }
            });
            if (detail_order_log_id.length > 0) {
                $.ajax({
                    url: `{{ route('user.deleteAllCart') }}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
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
                            for (let x in detail_order_log_id) {
                                let class_name = '.cart__table--body__items-' +
                                    detail_order_log_id[x];
                                let cart_restaurant = $(class_name).closest(
                                    '.cart-restaurant');
                                $(class_name).remove();
                                if (cart_restaurant.find('.cart__table--body__items')
                                    .length <= 0) {
                                    cart_restaurant.remove();
                                }
                            }
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
            } else {
                toastr.error('Chưa chọn dữ liệu cần xóa', {
                    timeOut: 5000
                });
            }
        });

        $('.continue__shopping--link').on('click', function() {
            let checkbox_one = $('.checkbox-one');
            if (checkbox_one.filter(":checked").is(":checked")) {
                console.log(1);
            } else {
                console.log(2);
            }
        });
    })
</script>
