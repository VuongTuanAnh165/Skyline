<!-- Select2 -->
<script>
    $(document).ready(function() {
        function setheight(img) {
            console.log(img.width());
            return img.css('height', (img.width() * 132) / 185 + 'px');
        }
        setheight($('.banner__items--thumbnail__img'));
        window.onresize = () => setheight($('.banner__items--thumbnail__img'));
    })
</script>