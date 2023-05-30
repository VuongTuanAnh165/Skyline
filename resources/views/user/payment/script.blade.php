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
                $(this).find('.sum_total_restaurant').text(new Intl.NumberFormat('it-IT', config)
                    .format(sum_price_restaurant)).data('price', sum_price_restaurant);
            })
        }
        sum_price_restaurant();

        function total_money() {
            let sum_total_restaurant = $('.sum_total_restaurant');
            let total_money = 0;
            sum_total_restaurant.each(function() {
                total_money += parseFloat($(this).data('price'));
            })
            let discount_restaurant = $('.tr-discount .current__price');
            discount_restaurant.each(function() {
                if ($(this).data('price')) {
                    total_money -= parseFloat($(this).data('price'));
                }
            })
            let promotion_skyline = $('.promotion-skyline .checkout__discount--code__input--field');
            if (promotion_skyline.length > 0) {
                if (promotion_skyline.val()) {
                    let discount = parseFloat(promotion_skyline.find(":selected").data('value'))
                    $('.tr-discount-skyline').removeClass('d-none')
                        .find(
                            '.current__price').text('-' + new Intl.NumberFormat('it-IT', config)
                            .format(discount)).data('price', discount);
                } else {
                    $('.tr-discount-skyline').addClass('d-none')
                        .find('.current__price').text('').data('price', '');
                }
            }
            $('.total-money').text(new Intl.NumberFormat('it-IT', config)
                .format(total_money)).data('price', total_money);
        }
        total_money();

        function into_money() {
            let into_money = parseFloat($('.total-money').data('price')) + parseFloat($('.shipping').data(
                'price'));
            if ($('.tr-discount-skyline .current__price').data('price')) {
                into_money -= parseFloat($('.tr-discount-skyline .current__price').data('price'))
            }
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
            let total_money = $('.total-money').data(
                'price');
            promotion_skyline.find('option').each(function() {
                if (parseFloat($(this).data('condition')) > parseFloat(total_money)) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
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
                    //     sum_total_restaurant = check_discount.closest('.cart__table--body').find(
                    //         '.sum_total_restaurant');
                    //     let price = parseFloat(sum_total_restaurant.data('price')) - parseFloat(
                    //         promotion_restaurant.find(":selected").data('value'))
                    //     sum_total_restaurant.text(new Intl.NumberFormat('it-IT', config)
                    //         .format(price)).data('price', price);
                    // } else {
                        sum_price_restaurant();
                    }
                    total_money();
                    into_money();
                }
            }
            // if (check_discount.hasClass('promotion-skyline')) {
            //     let promotion_skyline = check_discount.find('.checkout__discount--code__input--field');
            //     if (promotion_skyline.length > 0) {
            //         if (promotion_skyline.val()) {
            //             money_total = $('.total-money');
            //             let price = parseFloat(money_total.data('price')) - parseFloat(promotion_skyline
            //                 .find(":selected").data('value'))
            //             money_total.text(new Intl.NumberFormat('it-IT', config)
            //                 .format(price)).data('price', price);
            //         } else {
            //             total_money();
            //         }
            //         into_money();
            //     }
            // }
        })

        $('.pay-onl').on('click', function() {
            $('.checkout-paypal').removeClass('d-none');
            $(this).removeClass('bg__primary2').addClass('bg__primary');
        })

        $('.paypal-close').on('click', function() {
            $('.checkout-paypal').addClass('d-none');
            $('.pay-onl').addClass('bg__primary2').removeClass('bg__primary');
        })

        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/api/paypal/order/createCeo', {
                    method: 'POST',
                    body: JSON.stringify({

                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/captureCeo', {
                    method: 'POST',
                    body: JSON.stringify({
                        orderId: data.orderID,
                        'email': $("#email").val(),
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    window.location.href = $("#url-thanks").val();
                });
            }

        }).render('#paypal-button-container');
    })
</script>
