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
    })
</script>
