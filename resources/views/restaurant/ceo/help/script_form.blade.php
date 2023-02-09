<!-- Select2 -->
<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('.service_id').select2({
            placeholder: "Chọn dịch vụ"
        });
    })
</script>