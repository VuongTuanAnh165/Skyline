<script>
    $(document).ready(function() {
        $('.a-login').on('click', function() {
            $('.a-register').removeClass('active-background');
            $(this).addClass('active-background');
            $('.modal-login').removeClass('display-none');
            $('.modal-register').addClass('display-none');
            $('.card-left').removeClass('col-md-6').addClass('col-md-4');
            $('.card-right').removeClass('col-md-6').addClass('col-md-8');
        });

        $('.a-register').on('click', function() {
            $('.a-login').removeClass('active-background');
            $(this).addClass('active-background');
            $('.modal-register').removeClass('display-none');
            $('.modal-login').addClass('display-none');
            $('.card-left').removeClass('col-md-4').addClass('col-md-6');
            $('.card-right').removeClass('col-md-8').addClass('col-md-6');
        });

        $('#btn-service-create').on('click', function() {
            let id = $(this).data('id');
            let name_link = $(this).data('name_link');
            let service_charge_id = $('.service_charge_id').val();
            window.location = `/dich-vu/` + id + `-` + name_link + `/dang-ky/` + service_charge_id;
        });
    })
</script>