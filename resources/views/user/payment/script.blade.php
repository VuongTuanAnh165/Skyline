<script src="https://www.paypal.com/sdk/js?client-id={{ $skyline->client_id }}&currency=USD"></script>
<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        };

        function checkAdress() {
            if ($('#radiobox').is(':checked')) {
                $('.radiobox-div').removeClass('display-none');
                $('.radiobox2-div').addClass('display-none');
            } else {
                $('.radiobox2-div').removeClass('display-none');
                $('.radiobox-div').addClass('display-none');
                map.resize();
            }
        };
        checkAdress();
        $('.shipping__radio--input__field').on('click', function() {
            checkAdress();
        });

        function checkSeletedAdress() {
            let address = $('.radiobox-div .checkout__input--select__field option:selected');
            $('.radiobox-div .checkout__input--field').val(address.data('address'));
        };
        checkSeletedAdress();
        $('.radiobox-div .checkout__input--select__field').on('change', function() {
            checkSeletedAdress();
        });

        $(document).on('click', '.checkout__review--link__text.btn-edit', function() {
            $(this).closest('.checkout__review').find('input.checkout__review--content').prop(
                'disabled', false);
            $(this).closest('.checkout__review').find('.checkout__review--link__text.btn-save')
                .removeClass('display-none');
            $(this).addClass('display-none');
        })

        $(document).on('click', '.checkout__review--link__text.btn-save', function() {
            let btn_save = $(this);
            let btn_edit = $(this).closest('.checkout__review').find(
                '.checkout__review--link__text.btn-edit');
            let input_text = $(this).closest('.checkout__review').find(
                'input.checkout__review--content');
            let parent = $(this).closest('.checkout__contact--information2');
            let user_name = parent.find('input[name="name"]').val();
            let user_email = parent.find('input[name="email"]').val();
            let user_phone = parent.find('input[name="phone"]').val();
            $.ajax({
                url: `{{ route('user.updateProfile') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: user_name,
                    email: user_email,
                    phone: user_phone,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Cập nhật thông tin người nhận thành công', {
                            timeOut: 5000
                        });
                        btn_save.addClass('display-none');
                        btn_edit.removeClass('display-none');
                        input_text.prop('disabled', true);
                    } else {
                        toastr.error('Cập nhật thông tin người nhận thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Cập nhật thông tin người nhận thất bại', {
                        timeOut: 5000
                    });
                }
            });
        })

        function total() {
            let cart_table_body_items = $('.cart__table--body__items');
            cart_table_body_items.each(function() {
                let total = 0;
                let value_price = $(this).find('.value_price');
                value_price.each(function() {
                    total += Number($(this).val());
                });
                total = total * $(this).find('.quickview__value--number').val();
                $(this).find('.cart__price.end').text(new Intl.NumberFormat('it-IT', config).format(
                    total)).data('price', total);
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

        function sum_price_restaurant() {
            let cart_table_body = $(".cart__table--body");
            cart_table_body.each(function() {
                let sum_price_restaurant = 0;
                $(this).find('.cart__price.end').each(function() {
                    sum_price_restaurant += parseFloat($(this).data('price'));
                })
                let promotion_restaurant = $(this).find(
                    '.promotion-restaurant .checkout__discount--code__input--field');
                if (promotion_restaurant.length > 0) {
                    if (promotion_restaurant.val()) {
                        let discount = parseFloat(promotion_restaurant.find(":selected").data('value'))
                        promotion_restaurant.closest('.cart__table--body').find('.tr-discount')
                            .removeClass('d-none').find(
                                '.current__price').text('-' + new Intl.NumberFormat('it-IT', config)
                                .format(discount)).data('price', discount);
                    } else {
                        promotion_restaurant.closest('.cart__table--body').find('.tr-discount')
                            .addClass('d-none').find(
                                '.current__price').text('').data('price', '');
                    }
                }
                let promotion_skyline = $(this).find(
                    '.promotion-skyline .checkout__discount--code__input--field');
                if (promotion_skyline.length > 0) {
                    if (promotion_skyline.val()) {
                        let discount_skyline = parseFloat(promotion_skyline.find(":selected").data(
                            'value'))
                        promotion_skyline.closest('.cart__table--body').find('.tr-discount-skyline')
                            .removeClass('d-none').find(
                                '.current__price').text('-' + new Intl.NumberFormat('it-IT', config)
                                .format(discount_skyline)).data('price', discount_skyline);
                    } else {
                        promotion_skyline.closest('.cart__table--body').find('.tr-discount-skyline')
                            .addClass('d-none').find(
                                '.current__price').text('').data('price', '');
                    }
                }
                $(this).find('.sum_total_restaurant').text(new Intl.NumberFormat('it-IT', config)
                    .format(sum_price_restaurant)).data('price', sum_price_restaurant);
            })
        }
        sum_price_restaurant();

        function total_money() {
            let cart_table = $('.cart__table--body');
            $('.checkout__total--body').html('');
            cart_table.each(function() {
                let sum_total_restaurant = $(this).find('.sum_total_restaurant');
                let shipping = $(this).find('.shipping');
                let discount_restaurant = $(this).find('.tr-discount .current__price');
                let discount_skyline = $(this).find('.tr-discount-skyline .current__price');
                let total_money = parseFloat(sum_total_restaurant.data('price')) + parseFloat(shipping
                    .data('price'));
                if (discount_restaurant.data('price')) {
                    total_money -= parseFloat(discount_restaurant.data('price'));
                }
                if (discount_skyline.data('price')) {
                    total_money -= parseFloat(discount_skyline.data('price'));
                }
                let table_restaurant_name = $(this).find('.table-restaurant-name').text();
                let order_id = $(this).find('.order_user_log_order_id').val();
                let detail_order_logs = $(this).find('.detail_order_log_id');
                let detail_order_log_id = [];
                detail_order_logs.each(function() {
                    detail_order_log_id.push($(this).val());
                })
                let promotions = $(this).find('.checkout__discount--code__input--field');
                let promotion_id = [];
                promotions.each(function() {
                    if ($(this).val()) {
                        promotion_id.push($(this).val());
                    }
                });
                $('.checkout__total--body').append(`
                    <tr class="checkout__total--items">
                        <td class="checkout__total--title text-left">Tổng tiền ${table_restaurant_name}</td>
                        <td class="checkout__total--amount text-right total-money-restaurant" data-price = ${total_money}>${new Intl.NumberFormat('it-IT', config).format(total_money)}</td>
                        <input type="hidden" class="order_id" value="${order_id}"">
                        <input type="hidden" class="detail_order_log_id" value="${detail_order_log_id.join('-')}">
                        <input type="hidden" class="promotion_id" value="${promotion_id.join('-')}">
                        <input type="hidden" class="total_money" value="${total_money}">
                    </tr>
                `)
            });
        }
        total_money();

        function into_money() {
            let into_money = 0;
            let total_money_restaurant = $('.total-money-restaurant');
            total_money_restaurant.each(function() {
                if ($(this).data('price')) {
                    into_money += $(this).data('price');
                }
            })
            $('.into-money').text(new Intl.NumberFormat('it-IT', config)
                .format(into_money)).data('price', into_money);
        }
        into_money();

        function check_promotion_restaurant() {
            let promotion_restaurant = $('.promotion-restaurant .checkout__discount--code__input--field');
            promotion_restaurant.each(function() {
                let sum_total_restaurant = $(this).closest('.cart__table--body').find(
                    '.sum_total_restaurant').data('price');
                $(this).find('option').each(function() {
                    if (parseFloat($(this).data('condition')) > parseFloat(
                            sum_total_restaurant)) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                })
            })
        }
        check_promotion_restaurant();

        function check_promotion_skyline() {
            let promotion_skyline = $('.promotion-skyline .checkout__discount--code__input--field');
            promotion_skyline.each(function() {
                let sum_total_restaurant = $(this).closest('.cart__table--body').find(
                    '.sum_total_restaurant').data('price');
                $(this).find('option').each(function() {
                    if (parseFloat($(this).data('condition')) > parseFloat(
                            sum_total_restaurant)) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                })
            })
        }
        check_promotion_skyline();

        $(document).on('click', '.checkout__discount--code__btn', function() {
            let check_discount = $(this).closest('.checkout__discount--code');
            if (check_discount.hasClass('promotion-restaurant')) {
                let promotion_restaurant = check_discount.find(
                    '.checkout__discount--code__input--field');
                if (promotion_restaurant.length > 0) {
                    if (promotion_restaurant.val()) {
                        let discount = parseFloat(promotion_restaurant.find(":selected").data('value'));
                        promotion_restaurant.closest('.cart__table--body').find('.tr-discount')
                            .removeClass('d-none').find(
                                '.current__price').text('-' + new Intl.NumberFormat('it-IT', config)
                                .format(discount)).data('price', discount);
                    }
                }
            }
            if (check_discount.hasClass('promotion-skyline')) {
                let promotion_skyline = check_discount.find('.checkout__discount--code__input--field');
                if (promotion_skyline.length > 0) {
                    if (promotion_skyline.val()) {
                        let discount = parseFloat(promotion_skyline.find(":selected").data('value'));
                        promotion_skyline.closest('.cart__table--body').find('.tr-discount-skyline')
                            .removeClass('d-none')
                            .find(
                                '.current__price').text('-' + new Intl.NumberFormat('it-IT', config)
                                .format(discount)).data('price', discount);
                    }
                }
            }
            sum_price_restaurant();
            total_money();
            into_money();
        })

        $('.pay-onl').on('click', function() {
            $('.checkout-paypal').removeClass('d-none');
            $(this).removeClass('bg__primary2').addClass('bg__primary');
            $('.pay-off').prop('disabled', true);
        })

        $('.paypal-close').on('click', function() {
            $('.checkout-paypal').addClass('d-none');
            $('.pay-onl').addClass('bg__primary2').removeClass('bg__primary');
            $('.pay-off').prop('disabled', false);
        })

        function messErr(key) {
            let messId = [
                'Thiếu thông tin Tên người nhận',
                'Thiếu thông tin Email người nhận',
                'Thiếu thông tin SĐT người nhận',
                'Thiếu thông tin Địa chỉ có sẵn',
                'Thiếu thông tin Tên địa chỉ mới',
                'Thiếu thông tin Kinh độ',
                'Thiếu thông tin Vĩ độ',
                'Thiếu thông tin Địa chỉ mới',
            ];
            return messId[key];
        }

        //validate
        function validateItem() {
            let arrId = [
                'user_name',
                'user_email',
                'user_phone',
                'available_address',
                'user_address_name',
                'longitude',
                'latitude',
                'address',
            ];
            $('err-text').removeClass('err-text');
            let check = true;
            $.each(arrId, function(key, id) {
                if (id == 'user_name' || id == 'user_email' || id == 'user_phone') {
                    if ($(`#${id}`).val() == "") {
                        toastr.error(messErr(key), {
                            timeOut: 5000
                        });
                        $(`#${id}`).addClass('err-text');
                        check = false;
                    }
                } else {
                    if ($(".shipping__radio--input__field:checked").val() == 1) {
                        if (id == 'available_address') {
                            if ($(`#${id}`).val() == "") {
                                toastr.error(messErr(key), {
                                    timeOut: 5000
                                });
                                $(`#${id}`).addClass('err-text');
                                check = false;
                            }
                        }
                    } else {
                        if (id == 'user_address_name' || id == 'longitude' || id == 'latitude' || id ==
                            'address') {
                            if ($(`#${id}`).val() == "") {
                                toastr.error(messErr(key), {
                                    timeOut: 5000
                                });
                                $(`#${id}`).addClass('err-text');
                                check = false;
                            }
                        }
                    }
                }
            });
            return check;
        }

        $('input, select').on('change, keyup', function() {
            if ($(this).hasClass('err-text')) {
                $(this).removeClass('err-text');
            }
        })

        function getFormData() {
            var formData = new FormData();
            formData.append('user_id', `{{ auth()->guard('user')->user()->id }}`);
            formData.append('type_ship', $(".shipping__radio--input__field:checked").val());
            if ($(".shipping__radio--input__field:checked").val() == 1) {
                formData.append('available_address', $("#available_address").val());
            } else {
                formData.append('user_address_name', $("#user_address_name").val());
                formData.append('longitude', $("#longitude").val());
                formData.append('latitude', $("#latitude").val());
                formData.append('address', $("#address").val());
            }
            let cart = [];
            let checkout_total_cart = $('.checkout__total--items');
            checkout_total_cart.each(function() {
                item = {};
                let order_id = $(this).find('.order_id').val();
                let detail_order_log_id = $(this).find('.detail_order_log_id').val();
                let promotion_id = $(this).find('.promotion_id').val();
                let total_money = $(this).find('.total_money').val();
                item['order_id'] = order_id;
                item['detail_order_log_id'] = detail_order_log_id;
                item['promotion_id'] = promotion_id;
                item['total_money'] = total_money;
                cart.push(item)
            })
            formData.append('cart', JSON.stringify(cart));
            return formData;
        }

        //Thanh toán off
        $(".pay-off").on("click", function() {
            if (validateItem()) {
                $.ajax({
                    url: `{{ route('user.payment.post') }}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: getFormData(),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code == 200) {
                            if (!alert('Đặt hàng thành công! Ấn OK để tiếp tục')) {
                                window.location.href = response.url;
                            }
                        } else {
                            toastr.error('Đặt hàng thất bại', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Đặt hàng thất bại', {
                            timeOut: 5000
                        });
                    }
                });
            }
        });

        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/api/paypal/order/createUser', {
                    method: 'POST',
                    body: getFormData(),
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/captureUser', {
                    method: 'POST',
                    body: JSON.stringify({
                        orderId: data.orderID,
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    window.location.href = `{{route('user.my_account.order')}}`;
                });
            }

        }).render('#paypal-button-container');
    })
</script>
