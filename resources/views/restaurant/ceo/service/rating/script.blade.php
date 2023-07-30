<!-- Summernote -->
<script src="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('template_web_admin/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('template_web_admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.modal-rating', function() {
            let service_name = $(this).data('service_name');
            let email_register = $(this).data('email_register');
            let product_id = $(this).data('product_id');
            $('.service_name').text(service_name);
            $('.email_register').text(email_register);
            $('.product_id').val(product_id);
            $.ajax({
                url: `{{route('ceo.service.showRating')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'product_id': product_id,
                },
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $('#btn-rating').addClass('d-none');
                        $("#modalRating .modal-body").addClass("pe-none");
                        $("#modalRating .modal-header .modal-title span").text("(Đã đánh giá)");
                        if(response.data.comment) {
                            $('#comment').summernote('code', response.data.comment);
                        }
                        if(response.data.star) {
                            $('#star' + response.data.star).prop('checked', true);
                        }
                    } else {
                        $('#btn-rating').removeClass('d-none');
                        $("#modalRating .modal-body").removeClass("pe-none");
                        $("#modalRating .modal-header .modal-title span").text("(Chưa đánh giá)");
                        $('#comment').summernote('code', '');
                        $("input[name='star']").prop('checked', false);
                    }
                },
                error: function(xhr) {
                    $('#btn-rating').removeClass('d-none');
                    $("#modalRating .modal-body").removeClass("pe-none");
                    $("#modalRating .modal-header .modal-title span").text("(Chưa đánh giá)");
                    $('#comment').summernote('code', '');
                    $('#star' + response.data.star).prop('checked', false);
                }
            });
        })

        $('#comment').summernote({
            placeholder: "",
            tabsize: 2,
            height: 200,
            minHeight: 100,
            maxHeight: 300,
            focus: true,
            dialogsInBody: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['fontsizeunit', ['fontsizeunit']],
                ['color', ['color']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
            ],
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            codemirror: {
                mode: "htmlmixed",
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function(image, editor) {
                    let data = new FormData();
                    data.append('file', image[0]);
                    $.ajax({
                        url: `{{ route('upload.image.summernote') }}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: data,
                        type: 'post',
                        success: function(response) {
                            if (response.status == 200) {
                                var image = $('<img>').attr('src',
                                    `{{ asset('storage/') }}` + "/" + response.url);
                                $('#comment').summernote("insertNode", image[0]);
                            }
                        }
                    });
                }
            }
        });

        $('#btn-rating').on('click', function() {
            let product_id = $('.product_id').val();
            let comment = $('#comment').summernote('code');
            let star = $('input[name="star"]:checked').val();
            $.ajax({
                url: `{{route('ceo.service.rating')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    'product_id': product_id,
                    'comment' : comment,
                    'star' : star,
                },
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        $('#modalRating').modal('hide');
                        if(!alert('Đánh giá thành công! Ấn OK để tiếp tục')){window.location.reload();}
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    if(xhr.responseJSON.errors.star){
                        $(".error-star").text(xhr.responseJSON.errors.star);
                        $('#btn-rating').addClass('disabledbutton')
                    }
                }
            });
        });

        $('.check').on('keyup', function() {
            $('#btn-rating').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })

        $('.check').on('change', function() {
            $('#btn-rating').removeClass('disabledbutton');
            $('.error.error-be').text('');
        })
    })
</script>
