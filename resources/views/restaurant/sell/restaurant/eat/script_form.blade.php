<script src="{{ asset('template_web_admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.table_id').select2({
            placeholder: "Chọn bàn ăn",
        });
        $('.status').select2({
            placeholder: "Chọn trạng thái",
        });
        $('.dish_id').select2({
            placeholder: "Chọn món ăn",
        });

        function getTable() {
            $('.list-table').text('');
            $('#table_id option').each(function() {
                if ($(this).is(':selected')) {
                    $('.list-table').append(`<li>Bàn số: ` + $(this).text() + `</li>`);
                }
            });
        }
        getTable();

        function checkDeleteOrder() {
            if ($('#status').is(":checked")) {
                $("#btn-delete-order").prop('disabled', true);
                $("#btn-payment-order").prop('disabled', false);
            } else {
                $("#btn-delete-order").prop('disabled', false);
                $("#btn-payment-order").prop('disabled', true);
            }
        }
        checkDeleteOrder();

        function checkStatus() {
            if ($('.table-detail').find('tbody tr').length < 1 || $('#table_id option:selected').length < 1 || $('#status').is(":checked")) {
                $('#status').prop('disabled', true);
            } else {
                $('#status').prop('disabled', false);
            }
        }
        checkStatus();

        function checkTable() {
            if ($('#table_id option:selected').length < 1) {
                $('#table_id').after(`<div style="font-style: italic;" class="text-primary error_table_id">Bàn ăn không được bỏ trống</div>`);
                $('#btn-add-table').prop('disabled', true);
            } else {
                $('#btn-add-table').prop('disabled', false);
                $('.error_table_id').text('');
            }
        }
        checkTable();
        $('#table_id').on('change', function() {
            checkTable();
            checkStatus();
        })

        function checkDish() {
            if ($('.table-detail').find('tbody tr').length < 1) {
                $('.error_dish_id').text('');
                $('#dish_id').after(`<div style="font-style: italic;" class="text-primary error_dish_id">Vui lòng chọn món ăn</div>`);
            } else {
                $('.error_dish_id').text('');
            }

            if ($('#dish_id option').length < 1) {
                $('#btn-add-dish').prop('disabled', true);
            } else {
                $('#btn-add-dish').prop('disabled', false);
            }
        }
        checkDish();
        $('#dish_id').on('change', function() {
            checkDish();
            checkStatus();
        })
        $('#btn-add-table').on('click', function() {
            let url = $(this).data('url');
            let table_id = $('#table_id').val();
            let order_id = $('#order_id').val();
            $.ajax({
                url: url,
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
        })

        function checkedCheckbox() {
            if ($('#status').is(":checked")) {
                $("#btn-add-status").prop('disabled', false);
            } else {
                $("#btn-add-status").prop('disabled', true);
            }
        }
        $('#status').on('click', function() {
            checkedCheckbox();
        });
        $('#btn-add-status').on('click', function() {
            let url = $(this).data('url');
            let status = $('input[name="status"]:checked').val();
            let order_id = $('#order_id').val();
            if ($('#status').is(":checked")) {
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status,
                        order_id: order_id,
                    },
                    cache: false,
                    method: 'POST',
                    success: function(response) {
                        if (response.code == 200) {
                            toastr.success('Thêm bàn thành công', {
                                timeOut: 5000
                            });
                            $('.list-status').text('')
                            for (let x in response.data.status) {
                                $('.list-status').append(`
                                    <div class="ml-4">
                                        <p class="mb-0 text-black">` + $('.label-status').text() + `</p>
                                        <p class="mb-0 small">${response.data.status[x][1]}</p>
                                    </div>
                                `)
                            }
                            $("#btn-add-status").prop('disabled', true);
                            $("#status").prop('disabled', true);
                            checkDeleteOrder();
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
            }
        });

        $("#btn-show-dish").on('click', function() {
            let url = $(this).data('url');
            let order_id = $('#order_id').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    order_id: order_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.dishes.length > 0) {
                        toastr.success('Lấy món thành công', {
                            timeOut: 5000
                        });
                        $("select[name='dish_id']").html('');
                        $.each(response.dishes, function(key, value) {
                            if (jQuery.inArray(response.branch_id, value.branch_id) !== -1) {
                                $("select[name='dish_id']").append(
                                    "<option value=" + value.id + ">" + value.name + "</option>",
                                );
                            }
                        });
                        checkDish();
                        checkStatus();
                    } else {
                        toastr.error('Lấy món thất bại', {
                            timeOut: 5000
                        });
                    }
                },
            })
        });

        $('#btn-add-dish').on('click', function() {
            let url = $(this).data('url');
            let dish_id = $('#dish_id').val();
            let order_id = $('#order_id').val();
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    dish_id: dish_id,
                    order_id: order_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Lưu món thành công', {
                            timeOut: 5000
                        });
                        $("select[name='dish_id']").html('');
                        $(".form-dish").find('.select2-selection__choice').remove();
                        $('.table-detail').find('tbody').text('');
                        for (let x in response.data) {
                            let html_menu = '';
                            let array_menu_name = response.data[x].menu_name.split(",");
                            let array_detail_menu_log_id = response.data[x].detail_menu_log_id.split(",");
                            for (let i in array_menu_name) {
                                html_menu += `<button class='btn btn-info btn-sm btn-menu'>${array_menu_name[i]}</button>`;
                            };
                            $('.table-detail').find('tbody').append(`
                            <tr>
                                <td class="text-center">${response.data[x].dish_id}</td>
                                <td>${response.data[x].dish_name}</td>
                                <td class="text-center"><input type="number" id="td-quantity" name="td-quantity" value="${response.data[x].quantity}" disabled></td>
                                <td>` + html_menu + `</td>
                                <td class="text-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm btn-quantity">
                                        <i class="fas fa-pencil-alt"></i>
                                            Chỉnh số lượng món
                                    </a>
                                    <a href="javascript:void(0)" data-id ="${response.data[x].id}" data-url="{{ route('sell.restaurant.eat.quantity') }}" class="btn btn-danger btn-sm btn-quantity-save display-none">
                                        <span class="mdi mdi-check"></span>    
                                        Lưu số lượng món ăn
                                    </a>
                                    <a href="javascript:void(0)" data-detail_order_log_id="${response.data[x].id}" data-url="{{ route('sell.restaurant.eat.showItem') }}" class='btn btn-success btn-sm btn-menu-option' data-toggle="modal" data-target="#MenuItemModal">
                                        <i class="fas fa-pencil-alt"></i>    
                                        Chỉnh option menu
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-delete-dish" href="javascript:void(0);" data-detail_order_log_id="${response.data[x].id}" data-url="{{ route('sell.restaurant.eat.deleteDish') }}">
                                        <i class="fas fa-trash"></i>
                                        {{ __('messages.admin.table.destroy') }}
                                    </a>
                                </td>
                            </tr>
                            `)
                        }
                        checkDish();
                        checkStatus();
                    } else {
                        toastr.error('Lưu món thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Lưu món thất bại', {
                        timeOut: 5000
                    });
                }
            });
        });

        $(document).on('click', '.btn-delete-dish', function() {
            let detail_order_log_id = $(this).data('detail_order_log_id');
            let url = $(this).data('url');
            let btn_delete_dish = $(this);
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    detail_order_log_id: detail_order_log_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Xóa món ăn thành công', {
                            timeOut: 5000
                        });
                        btn_delete_dish.parent().parent().remove();
                        checkDish();
                        checkStatus();
                    } else {
                        toastr.error('Xóa món ăn thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Lưu món thất bại', {
                        timeOut: 5000
                    });
                }
            });
        });

        $(document).on('click', '.btn-quantity', function() {
            let input_quantity = $(this).parent().parent().find("#td-quantity");
            let btn_quantity_save = $(this).parent().find('.btn-quantity-save');
            input_quantity.prop('disabled', false);
            btn_quantity_save.removeClass('display-none');
            $(this).addClass('display-none');
        });

        $(document).on('click', '.btn-quantity-save', function() {
            let btn_quantity_save = $(this);
            let input_quantity = btn_quantity_save.parent().parent().find("#td-quantity");
            let btn_quantity = btn_quantity_save.parent().find('.btn-quantity');
            let url = btn_quantity_save.data('url');
            let id = btn_quantity_save.data('id');
            let quantity = input_quantity.val();
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    quantity: quantity,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success('Cập nhật số lượng món thành công', {
                            timeOut: 5000
                        });
                        input_quantity.val(response.data.quantity);
                        input_quantity.prop('disabled', true);
                        btn_quantity_save.addClass('display-none');
                        btn_quantity.removeClass('display-none');
                    } else {
                        toastr.error('Cập nhật số lượng món thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Cập nhật số lượng món thất bại', {
                        timeOut: 5000
                    });
                }
            });
        });

        $(document).on('click', '.btn-menu-option', function() {
            let btn_menu_option = $(this);
            let url = btn_menu_option.data('url');
            let detail_order_log_id = btn_menu_option.data('detail_order_log_id');
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    detail_order_log_id: detail_order_log_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        $('.modal-title-menu').text(response.detail_order_log.dish_name + ' - Số lượng: ' + response.detail_order_log.quantity);
                        $('.modal-body').find('form').html('');
                        let stt = 0;
                        if (response.detail_item_logs.length > 0) {
                            if (response.detail_item_logs.length >= response.detail_order_log.quantity) {
                                for (let i = 0; i < response.detail_order_log.quantity; i++) {
                                    let html = '';
                                    for (let x in response.detail_menu_logs) {
                                        let array_item_id = response.detail_menu_logs[x].item_id.split(",");
                                        let array_item_name = response.detail_menu_logs[x].item_name.split(",");
                                        let required = response.detail_menu_logs[x].required == 1 ? 'required' : '';
                                        let multiple = response.detail_menu_logs[x].multiple == 1 ? 'multiple' : '';
                                        html_item = '';
                                        for (let j in array_item_name) {
                                            let check_selected = '';
                                            if (jQuery.inArray(array_item_id[j], response.detail_item_logs[i].item[x][1]) !== -1) {
                                                check_selected = 'selected';
                                            } else {
                                                check_selected = '';
                                            }
                                            html_item += `<option value="${array_item_id[j]}" ` + check_selected + `>${array_item_name[j]}</option>`;
                                        };
                                        html += `
                                            <div class="form-group form-item">
                                                <label class="form-label small font-weight-bold ${required}">${response.detail_menu_logs[x].menu_name}</label><br>
                                                <input type="hidden" name="menu_id" value="${response.detail_menu_logs[x].menu_id}">
                                                <select ${required} class="custom-select form-control select2 item_id ${required}" id="item_id_${stt}" name="item_id" ${multiple}>
                                                    ` + html_item + `
                                                </select>
                                            </div>
                                        `;
                                        stt++;
                                    }
                                    $('.modal-body').find('form').append(`
                                        <h5>${i+1}</h5>
                                        <div class="form-row form-row-group">
                                            ` + html + `
                                        </div>
                                    `)
                                }
                            } else {
                                for (let i = 0; i < response.detail_item_logs.length; i++) {
                                    let html = '';
                                    for (let x in response.detail_menu_logs) {
                                        let array_item_id = response.detail_menu_logs[x].item_id.split(",");
                                        let array_item_name = response.detail_menu_logs[x].item_name.split(",");
                                        let required = response.detail_menu_logs[x].required == 1 ? 'required' : '';
                                        let multiple = response.detail_menu_logs[x].multiple == 1 ? 'multiple' : '';
                                        html_item = '';
                                        for (let j in array_item_name) {
                                            let check_selected = '';
                                            if (jQuery.inArray(array_item_id[j], response.detail_item_logs[i].item[x][1]) !== -1) {
                                                check_selected = 'selected';
                                            } else {
                                                check_selected = '';
                                            }
                                            html_item += `<option value="${array_item_id[j]}" ` + check_selected + `>${array_item_name[j]}</option>`;
                                        };
                                        html += `
                                            <div class="form-group form-item">
                                                <label class="form-label small font-weight-bold ${required}">${response.detail_menu_logs[x].menu_name}</label><br>
                                                <input type="hidden" name="menu_id" value="${response.detail_menu_logs[x].menu_id}">
                                                <select ${required} class="custom-select form-control select2 item_id ${required}" id="item_id_${stt}" name="item_id" ${multiple}>
                                                    ` + html_item + `
                                                </select>
                                            </div>
                                        `;
                                        stt++;
                                    }
                                    $('.modal-body').find('form').append(`
                                        <h5>${i+1}</h5>
                                        <div class="form-row form-row-group">
                                            ` + html + `
                                        </div>
                                    `)
                                }
                                for (let i = 0; i < response.detail_order_log.quantity - response.detail_item_logs.length; i++) {
                                    let html = '';
                                    for (let x in response.detail_menu_logs) {
                                        let array_item_id = response.detail_menu_logs[x].item_id.split(",");
                                        let array_item_name = response.detail_menu_logs[x].item_name.split(",");
                                        let required = response.detail_menu_logs[x].required == 1 ? 'required' : '';
                                        let multiple = response.detail_menu_logs[x].multiple == 1 ? 'multiple' : '';
                                        html_item = '';
                                        for (let j in array_item_name) {
                                            html_item += `<option value="${array_item_id[j]}">${array_item_name[j]}</option>`;
                                        };
                                        html += `
                                            <div class="form-group form-item">
                                                <label class="form-label small font-weight-bold ${required}">${response.detail_menu_logs[x].menu_name}</label><br>
                                                <input type="hidden" name="menu_id" value="${response.detail_menu_logs[x].menu_id}">
                                                <select ${required} class="custom-select form-control select2 item_id ${required}" id="item_id_${stt}" name="item_id" ${multiple}>
                                                    ` + html_item + `
                                                </select>
                                            </div>
                                        `;
                                        stt++;
                                    }
                                    $('.modal-body').find('form').append(`
                                        <h5>${i+1}</h5>
                                        <div class="form-row form-row-group">
                                            ` + html + `
                                        </div>
                                    `)
                                }
                            }
                        } else {
                            for (let i = 0; i < response.detail_order_log.quantity; i++) {
                                let html = '';
                                for (let x in response.detail_menu_logs) {
                                    let array_item_id = response.detail_menu_logs[x].item_id.split(",");
                                    let array_item_name = response.detail_menu_logs[x].item_name.split(",");
                                    let required = response.detail_menu_logs[x].required == 1 ? 'required' : '';
                                    let multiple = response.detail_menu_logs[x].multiple == 1 ? 'multiple' : '';
                                    html_item = '';
                                    for (let j in array_item_name) {
                                        html_item += `<option value="${array_item_id[j]}">${array_item_name[j]}</option>`;
                                    };
                                    html += `
                                        <div class="form-group form-item">
                                            <label class="form-label small font-weight-bold ${required}">${response.detail_menu_logs[x].menu_name}</label><br>
                                            <input type="hidden" name="menu_id" value="${response.detail_menu_logs[x].menu_id}">
                                            <select ${required} class="custom-select form-control select2 item_id ${required}" id="item_id_${stt}" name="item_id" ${multiple}>
                                                ` + html_item + `
                                            </select>
                                        </div>
                                    `;
                                    stt++;
                                }
                                $('.modal-body').find('form').append(`
                                    <h5>${i+1}</h5>
                                    <div class="form-row form-row-group">
                                        ` + html + `
                                    </div>
                                `)
                            }
                        }
                        for (let i = 0; i < $('.item_id').length; i++) {
                            $(`#item_id_${i}`).select2({
                                placeholder: "Chọn option",
                            });
                        }
                        $("#btn-item-save").data('detail_order_log_id', response.detail_order_log.id);
                    } else {
                        toastr.error('Chỉnh menu thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Chỉnh menu thất bại', {
                        timeOut: 5000
                    });
                }
            });
        });

        $("#btn-item-save").on('click', function() {
            let form_row_group = $('.form-row-group');
            let array_item = [];
            let check = true;
            let menu = $('.form-row-group select.required');
            menu.each(function() {
                let item_id = $(this).val();
                if (!item_id || item_id.length <= 0) {
                    check = false;
                    return false;
                }
            })
            if (check) {
                form_row_group.each(function() {
                    let menu_id = $(this).find("input[name='menu_id']");
                    let arr_new = [];
                    menu_id.each(function() {
                        arr_new.push([
                            $(this).val(),
                            $(this).parent().find($("select[name=item_id]")).val().length ? $(this).parent().find($("select[name=item_id]")).val() : [-1],
                        ]);
                    });
                    array_item.push(arr_new)
                });
                let detail_order_log_id = $(this).data('detail_order_log_id');
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        detail_order_log_id: detail_order_log_id,
                        array_item: array_item,
                    },
                    cache: false,
                    method: 'POST',
                    success: function(response) {
                        if (response.code == 200) {
                            toastr.success('Cập nhật số lượng món thành công', {
                                timeOut: 5000,
                            });
                        } else {
                            toastr.error('Cập nhật số lượng món thất bại', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Cập nhật số lượng món thất bại', {
                            timeOut: 5000
                        });
                    }
                });
            } else {
                toastr.error('Nhập thiếu', {
                    timeOut: 5000
                });
            }
        });

        $("#btn-delete-order").on('click', function() {
            let order_id = $('#order_id').val();
            let url = $(this).data('url');
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: order_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        window.location = "{{route('sell.restaurant.eat.index')}}";
                    } else {
                        toastr.error('Hủy đơn thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Hủy đơn thất bại', {
                        timeOut: 5000
                    });
                }
            });
        });
    })
</script>