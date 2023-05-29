<script src="https://www.paypal.com/sdk/js?client-id={{$skyline->client_id}}&currency=USD"></script>
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
            let input_text = $(this).closest('.checkout__review').find('input.checkout__review--content');
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
                console.log(value_price);
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
