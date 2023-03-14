<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.widget__categories--menu__list', function() {
            let categoryHome = $(this).data('categoryhome');
            $('#input-categoryHome').val(categoryHome);
            $('#product-redirect').submit();
        });
        $(document).on('click', '.btn-search-price', function() {
            let priceMin = $(this).parent().find('.price-min').val();
            $('#price-min').val(priceMin);
            let priceMax = $(this).parent().find('.price-max').val();
            $('#price-max').val(priceMax);
            $('#product-redirect').submit();
        });
        $(document).on('change', '.product__view--select', function() {
            $('#sort').val($(this).val());
            $('#product-redirect').submit();
        })

        $('.quickview__cart--btn').on('click', function() {
            let dish_id = $(this).parent().find('.dish_id').val();
            let
            $.ajax({
                url: `{{route('user.addCart')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    table_id: table_id,
                    order_id: order_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Thêm bàn thành công', {
                            timeOut: 5000
                        });
                        getTable();
                        checkStatus();
                    } else {
                        toastr.error('Thêm bàn thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Thêm bàn thất bại', {
                        timeOut: 5000
                    });
                }
            });
            // var cart = $('.minicart__open--btn');
            // var imgtodrag = $('.swiper-wrapper').find('.swiper-slide-active').find("img").eq(0);
            // if (imgtodrag) {
            //     var imgclone = imgtodrag.clone()
            //         .offset({
            //             top: imgtodrag.offset().top,
            //             left: imgtodrag.offset().left
            //         })
            //         .css({
            //             'opacity': '0.5',
            //             'position': 'absolute',
            //             'height': '300px',
            //             'width': '300px',
            //             'z-index': '100'
            //         })
            //         .appendTo($('body'))
            //         .animate({
            //             'top': cart.offset().top + 10,
            //             'left': cart.offset().left + 10,
            //             'width': 75,
            //             'height': 75
            //         }, 1000, 'easeInOutExpo');

            //     setTimeout(function() {
            //         cart.effect("shake", {
            //             times: 2
            //         }, 200);
            //     }, 1500);

            //     imgclone.animate({
            //         'width': 0,
            //         'height': 0
            //     }, function() {
            //         $(this).detach()
            //     });
            // }
        });
    })
</script>