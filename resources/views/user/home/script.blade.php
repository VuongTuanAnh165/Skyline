<!-- Select2 -->
<script>
    $(document).ready(function() {
        function setheight(img) {
            return img.css('height', (img.width() * 132) / 185 + 'px');
        }
        function setheight2(img) {
            return img.css('height', img.width() + 'px');
        }
        setheight($('.banner__items--thumbnail__img'));
        setheight2($('.categories2__product--img'));
        $(window).on('resize', function() {
            setheight($('.banner__items--thumbnail__img'));
            setheight2($('.categories2__product--img'));
        });
    })
</script>