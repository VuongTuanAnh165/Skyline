<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.widget__categories--menu__list', function() {
            let category = $(this).data('category');
            $('#input-category').val(category);
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
        $(document).on('click', '.pagination__item', function() {
            console.log(1111);
            $('#product-redirect').submit();
        })
        $(document).on('click', '.pagination__item--arrow', function() {
            console.log(2222);
            $('#product-redirect').submit();
        })
    })
</script>