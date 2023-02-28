<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{$skyline->client_id}}&currency=USD"></script>
<script>
    $(document).ready(function() {
        $('.promotion_id').select2({
            placeholder: "Chọn chương trình khuyến mãi"
        });
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        }
        var [file] = '';
        imgInp.onchange = evt => {
            [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        $(document).on('click', '.edit-profile', function() {
            let parent = $(this).closest('.profile-ceo');
            parent.find('input').prop('disabled', false);
            let save = parent.find('.save-profile');
            let reset = parent.find('.reset-profile');
            save.removeClass('display-none');
            reset.removeClass('display-none');
            $(this).addClass('display-none');
            $('.continue').addClass('display-none');
        })

        function resetProfile() {
            $('.profile-ceo').find('input').prop('disabled', true);
            $('.profile-ceo').find('.save-profile').addClass('display-none');
            $('.profile-ceo').find('.reset-profile').addClass('display-none');
            $('.profile-ceo').find('.edit-profile').removeClass('display-none');
            $('.continue').removeClass('display-none');
        }

        $(document).on('click', '.reset-profile', function() {
            resetProfile();
        })
        $(document).on('click', '.save-profile', function() {
            let parent = $(this).closest('.profile-ceo');
            let name = parent.find('input[name="name"]').val();
            let phone = parent.find('input[name="phone"]').val();
            let email = parent.find('input[name="email"]').val();
            let cmnd = parent.find('input[name="cmnd"]').val();
            let address = parent.find('input[name="address"]').val();
            let data = new FormData();
            data.append('avatar', file);
            data.append('name', name);
            data.append('phone', phone);
            data.append('email', email);
            data.append('cmnd', cmnd);
            data.append('address', address);
            $.ajax({
                url: `{{route('ceo.hire.updateProfile')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                method: 'POST',
                success: function(response) {
                    if (response.status == 200) {
                        resetProfile();
                        $('.span-ceo-name').text(response.ceo.name);
                        $('.span-ceo-address').text(response.ceo.address);
                        $('.span-ceo-phone').text(response.ceo.phone);
                        $('.span-ceo-email').text(response.ceo.email);
                    }
                }
            });
        })
        $(document).on('click', '.check-email', function() {
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
                        $('#email_service').parent().after('<p class="success check-email-response">Email thỏa mãn</p>');
                        $('.under-email').removeClass('display-none');
                        $('.check-email').addClass('display-none');
                        $('#email_service').prop('disabled', true);
                        $('.table-check-email').text(email_service);
                        $('.continue').removeClass('display-none');
                    }
                },
                error: function(xhr) {
                    $('#email_service').parent().after('<p class="error check-email-response">' + xhr.responseJSON.errors.email + '</p>')
                    $('.check-email').prop('disabled', true);
                }
            });
        })

        $('.under-email').on('click', function() {
            $('#email_service').prop('disabled', false);
            $('.under-email').addClass('display-none');
            $('.check-email').removeClass('display-none');
            $('.check-email-response').text('');
            $('.continue').addClass('display-none');
        });

        $('#email_service').on('keyup', function() {
            $('.check-email-response').text('');
            $('.check-email').prop('disabled', false);
        });

        $('#email_service').on('change', function() {
            $('.check-email-response').text('');
            $('.check-email').prop('disabled', false);
        });

        $('.continue').on('click', function() {
            $('.content-order').removeClass('display-none');
            $('.content-profile').addClass('display-none');
        })

        $('.back').on('click', function() {
            $('.content-order').addClass('display-none');
            $('.content-profile').removeClass('display-none');
        })

        $(document).on('change', '.promotion_id', function() {
            let promotion_id = $('.promotion_id').val();
            let subtotal = $('#subtotal').val();
            $.ajax({
                url: `{{route('ceo.hire.showPromotion')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'promotion_id': promotion_id
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 200) {
                        let discount = 0;
                        for (let x in response.data) {
                            discount += subtotal * (response.data[x].value / 100)
                        }
                        let total = subtotal - discount ? subtotal - discount : 0;
                        $('.total').text(new Intl.NumberFormat('it-IT', config).format(total));
                        $('#total').val(total);
                    } else {
                        $('.total').text(new Intl.NumberFormat('it-IT', config).format(subtotal));
                        $('#total').val(subtotal);
                    }
                },
                error: function(xhr) {
                    $('.total').text(new Intl.NumberFormat('it-IT', config).format(subtotal));
                    $('#total').val(subtotal);
                }
            });
        })

        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/api/paypal/order/createCeo', {
                    method: 'POST',
                    body: JSON.stringify({
                        'order_id': $("#order_id").val(),
                        'ceo_id': "{{auth()->guard('ceo')->user()->id}}",
                        'service_charge_id': $("#service_charge_id").val(),
                        'type': 1,
                        'implementation_date': $("#implementation_date").val(),
                        'promotion_id': $("#promotion_id").val(),
                        'email': $("#email_service").val(),
                        'subtotal': $("#subtotal").val(),
                        'total': $("#total").val(),
                    })
                }).then(function(res) {
                    //res.json();
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
                    window.location.href = `{{route('thankyou.index')}}`;
                });
            }

        }).render('#paypal-button-container');
    })
</script>