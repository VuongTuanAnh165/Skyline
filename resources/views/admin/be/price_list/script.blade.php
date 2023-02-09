<!-- DataTables  & Plugins -->
<script src="{{ asset('template_web_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script src="{{ asset('template_web_admin/dist/js/demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })

        $(document).on('click', '.btn-show', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `{{route('admin.help.show')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'id': id
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 200) {
                        $('.help-id').val(response.data.id);
                        $('.modal-question').text(response.data.question);
                        $('.modal-answer').text(response.data.answer);
                    } else {
                        $('.help-id').val('');
                        $('.modal-question').text('');
                        $('.modal-answer').text('');
                    }
                },
                error: function(xhr) {
                    $('.help-id').val('');
                    $('.modal-question').text('');
                    $('.modal-answer').text('');
                }
            });
        })

        $(document).on('click', '.save-answer', function() {
            let id = $('.help-id').val();
            let answer = $('.modal-answer').val();
            $.ajax({
                url: `{{route('admin.help.store')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'id': id,
                    'answer' : answer,
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalFormCategory').modal('hide');
                        if(!alert('Cập nhật thành công! Ấn OK để tiếp tục')){window.location.reload();}
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    if(xhr.responseJSON.errors.answer){
                        $(".modal-answer").after(`<div class="error error-be">`+xhr.responseJSON.errors.answer+`</div>`);
                        $('.save-answer').addClass('disabledbutton')
                    }
                }
            });
        })

        $('.modal-answer').on('keyup', function() {
            $('.save-answer').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.modal-answer').on('change', function() {
            $('.save-answer').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>