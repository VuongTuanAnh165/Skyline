<!-- Select2 -->
<script>
    $(document).ready(function() {
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        };
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

        function setPrice() {
            let variant_size_list = $('.variant__size--list');
            let dish_price = Number($('#dish-price').val());
            variant_size_list.each(function() {
                let item = $(this).find('input');
                if (item.is(":checked")) {
                    dish_price += Number(item.data('add_price'));
                }
            })
            $('.current__price-dish-price').text(new Intl.NumberFormat('it-IT', config).format(
                dish_price))
        };

        setPrice();
        $(document).on('click', '.variant__size--list input', function() {
            setPrice();
        });

        function addCard() {
            var cart = $('.minicart__open--btn');
            var imgtodrag = $('.swiper-wrapper').find('.swiper-slide-active').find("img").eq(0);
            if (imgtodrag) {
                var imgclone = imgtodrag.clone()
                    .offset({
                        top: imgtodrag.offset().top,
                        left: imgtodrag.offset().left
                    })
                    .css({
                        'opacity': '0.5',
                        'position': 'absolute',
                        'height': '300px',
                        'width': '300px',
                        'z-index': '100'
                    })
                    .appendTo($('body'))
                    .animate({
                        'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1000, 'easeInOutExpo');

                setTimeout(function() {
                    cart.effect("shake", {
                        times: 2
                    }, 200);
                }, 1500);

                imgclone.animate({
                    'width': 0,
                    'height': 0
                }, function() {
                    $(this).detach()
                });
            }
        }

        $('.quickview__cart--btn').on('click', function() {
            let user_id = $('.user_id').val();
            let parent = $(this).parent().parent();
            if (user_id) {
                let dish_id = parent.find('.dish_id').val();
                let restaurant_id = parent.find('.restaurant_id').val();
                let quantity = parent.find('.quantity__number').val();
                let menu = parent.find('.menu');
                let item = [];
                let check = true;
                menu.each(function() {
                    let menu_menu_item = [];
                    let menu_id = $(this).val();
                    menu_menu_item.push(menu_id);
                    let class_menu_item = '.menu_' + menu_id;
                    let list_menu_item = parent.find(class_menu_item);
                    let menu_item = list_menu_item.find("input[name='menu_" + menu_id +
                        "']:checked:enabled");
                    if (list_menu_item.hasClass('required') && menu_item.length <= 0) {
                        toastr.error(list_menu_item.data('name') + ' là bắt buộc!', {
                            timeOut: 5000
                        });
                        item = [];
                        check = false;
                        return false;
                    }
                    let menu_item_id = []
                    menu_item.each(function() {
                        menu_item_id.push($(this).val());
                    })
                    menu_menu_item.push(menu_item_id);
                    item.push(menu_menu_item);
                });
                let branch = $('#branch_id:checked:enabled');
                if(branch.length <= 0) {
                    toastr.error('Chi nhánh là bắt buộc!', {
                        timeOut: 5000
                    });
                    check = false;
                    return false;
                }
                let branch_id = branch.val();
                if (check) {
                    $.ajax({
                        url: `{{ route('user.addCart') }}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            dish_id: dish_id,
                            restaurant_id: restaurant_id,
                            quantity: quantity,
                            item: item,
                            user_id: user_id,
                            branch_id: branch_id,
                        },
                        cache: false,
                        method: 'POST',
                        success: function(response) {
                            if (response.code == 200) {
                                toastr.success('Đã thêm vào giỏ hàng', {
                                    timeOut: 5000
                                });
                                addCard();
                                $('.minicart__open--btn').find('.items__count').text(
                                    response.data.length);
                            } else {
                                toastr.error('Thêm giỏ hàng thất bại', {
                                    timeOut: 5000
                                });
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Thêm giỏ háng thất bại', {
                                timeOut: 5000
                            });
                        }
                    });
                }
            } else {
                redirectUser();
            }
        });
    })
</script>
