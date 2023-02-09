jQuery(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    // Slide Toggle Filters
    $('.btn-show-table-options').click(function (t) {
        t.preventDefault(),
            $(this).closest(".dataTables_wrapper").find(".table-configuration-wrap").slideToggle(500)
    });
    $('#lfm').click(function (t) {
        t.preventDefault();
        $(this).parents('.image-box').find('.btn_remove_image').closest(".image-box").find(".preview-image-wrapper").show();
    });
    $('.lfm').click(function (t) {
        t.preventDefault();
        $(this).parents('.image-box').find('.btn_remove_image').closest(".image-box").find(".preview-image-wrapper").show();
    });
    $(document).on("click", ".btn_remove_image", function (e) {
        e.preventDefault();
        $(this).parents(".image-box").find(".preview-image-wrapper").hide();
        $(this).parents(".image-box").find(".image-data").val("")
    });
    $('.lfm').click(function () {
        $("#" + $(this).data('input')).click();
    });
    $(".image-data").change(function () {
        readURL(this);
    });
    $(document).on("click", ".btn_remove_image", function (e) {
        e.preventDefault();
        $('input[name="avatar"]').val('');
        $('input[name="file"]').val('');
        var url = '/admin/images/placeholder.png';
        $(this).parents(".image-box").find(".preview_image").attr('src' , url );
        $(this).parents(".image-box").find(".image-data").val("");
        $(this).parents(".image-box").find(".preview-image-wrapper").show();
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + $(input).attr('data-preview')).attr('src', e.target.result);
                $('input[name=image_base64]').val(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            $('input.input-file').css('display', 'none');
        }
    }
});

var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function () {
        selected.push($(this).data('id'));
    });
    return selected;
}

function destroy(id, model, url, title = 'Bạn chắc chắn không?', text, current_page = false) {
    swal({
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Ok",
        cancelButtonText: "Cancel",
        preConfirm: function () {
            return new Promise(function (resolve) {
                setTimeout(function () {
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        },
                        type: "POST",
                        url: url,
                        data: {
                            id: id,
                            model: model,
                            _method: 'delete',
                            current_page: current_page
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                swal('Success!', data.msg, 'success');
                                location.reload();
                            }
                        }
                    });
                }, 1000);
            });
        }
    }).then(function (data) {
        swal('Error!', data.msg, 'error');
    });
}
