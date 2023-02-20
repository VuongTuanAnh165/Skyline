<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        }
        $('#promotion_id').select2({
            placeholder: "Chọn chương trình khuyến mãi",
        });

        function subtotal() {
            let sub_total = 0;
            $( ".value_price" ).each(function() {
                sub_total += Number($(this).val());
            });
            $('#sub_total').val(sub_total);
            $('#p_sub_total').text(new Intl.NumberFormat('it-IT', config).format(sub_total));
        }
        subtotal();

        function selectPromotion() {
            $( "#promotion_id option" ).each(function() {
                let promotion_condition = $(this).data('promotion_condition');
                if(promotion_condition >= $('#sub_total').val()) {
                    $(this).prop('disabled', true);
                }
            });
        }
        selectPromotion();

        function getPromotion() {
            $('.div_promotion').text('');
            $('#promotion_id option').each(function() {
                if ($(this).is(':selected')) {
                    let html = `
                        <div class="d-flex align-items-center pt-2 border-top">
                            <p class="text-dark font-weight-bold m-0">`+ $(this).text() +`</p>
                            <p class="ml-auto text-danger m-0"> - `+ new Intl.NumberFormat('it-IT', config).format($(this).data('promotion_value')) +`</p>
                            <input type="hidden" class="minus_price" value="`+ $(this).data('promotion_value') +`">
                        </div>
                    `
                    $('.div_promotion').append(html);
                }
            });
        }
        getPromotion();

        $('#btn_add_promotion').on('click', function() {
            let url = $(this).data('url');
            let promotion_id = $('#promotion_id').val();
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    promotion_id: promotion_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Thêm chương trình khuyến mãi thành công', {
                            timeOut: 5000
                        });
                        getPromotion();
                        intoMoney();
                    } else {
                        toastr.error('Thêm chương trình khuyến mãi thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Thêm chương trình khuyến mãi thất bại', {
                        timeOut: 5000
                    });
                }
            });
        })

        function intoMoney() {
            let minus_price = 0;
            $( ".minus_price" ).each(function() {
                minus_price += Number($(this).val());
            });
            let into_money = $('#sub_total').val() - minus_price > 0 ? $('#sub_total').val() - minus_price : 0;
            $('#into_money').val(into_money);
            $('#a_into_money').text(new Intl.NumberFormat('it-IT', config).format(into_money));
        }
        intoMoney();

        $("#btn_payments_onl").on('click', function() {
            $('.payments_onl').removeClass('display-none');
            $('.payments_off').addClass('display-none');
        });

        $("#btn_payments_off").on('click', function() {
            $('.payments_off').removeClass('display-none');
            $('.payments_onl').addClass('display-none');
        });

        $("#input_payment").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur) {
            var input_val = input.val();
            if (input_val === "") {
                return;
            }
            var original_len = input_val.length;
            var caret_pos = input.prop("selectionStart");
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);
                left_side = formatNumber(left_side);
                right_side = formatNumber(right_side);
                if (blur === "blur") {
                    right_side += "00";
                }
                right_side = right_side.substring(0, 2);
                input_val = left_side + "." + right_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = input_val;
            }
            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $("#btn_payment").on('click', function () {
            let payment = Number($("#input_payment").val().replace(/,/g, ''));
            let exchange = 0;
            if(payment - $('#into_money').val() > 0) {
                exchange = payment - $('#into_money').val();
                $('.exchange').text('Tiền trả lại');
                $('#btn_payment_off_sussces').prop('disabled', false)
            } else {
                exchange = $('#into_money').val() - payment;
                $('.exchange').text('Tiền còn thiếu');
            }
            $("#exchange").val(new Intl.NumberFormat('it-IT', config).format(exchange))
        });

        $("#btn_payment_off_sussces").on('click', function() {
            let url = $(this).data('url');
            let promotion_id = $('#promotion_id').val();
            let total_money = $('#into_money').val();
            let payment = Number($("#input_payment").val().replace(/,/g, ''));
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    promotion_id: promotion_id,
                    total_money: total_money,
                    payment: payment,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        if (!alert('Thanh toán thành công! Ấn OK để tiếp tục')) {
                            window.open(response.url, '_blank');
                            window.location = `{{route('sell.restaurant.eat.order')}}`;
                        }
                    } else {
                        toastr.error('Thanh toán thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Thanh toán thất bại', {
                        timeOut: 5000
                    });
                }
            });
        })

        $("#btn_payment_onl_sussces").on('click', function() {
            let url = $(this).data('url');
            let promotion_id = $('#promotion_id').val();
            let total_money = $('#into_money').val();
            let payment = $('#into_money').val();
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    promotion_id: promotion_id,
                    total_money: total_money,
                    payment: payment,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        if (!alert('Thanh toán thành công! Ấn OK để tiếp tục')) {
                            window.open(response.url, '_blank');
                            window.location = `{{route('sell.restaurant.eat.order')}}`;
                        }
                    } else {
                        toastr.error('Thanh toán thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Thanh toán thất bại', {
                        timeOut: 5000
                    });
                }
            });
        })
    })
</script>