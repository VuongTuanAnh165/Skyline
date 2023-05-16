<!-- Select2 -->
<script>
    $(document).ready(function() {
        jQuery.validator.setDefaults({
            ignore: ":hidden, [contenteditable='true']:not([name])"
        });

        function checkCreateItem() {
            $('#form-item').find('.create').eq($('#form-item').find('.create').length - 1).removeClass(
                'display-none');
            $('#form-item').find('.delete').eq($('#form-item').find('.create').length - 1).removeClass(
                'display-none');
            $('#form-item').find('.delete').eq(0).addClass('display-none');
        };
        checkCreateItem();

        var html_no_item = `
            <div class="row row-item">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Tên" value="{{ old('name') ? old('name') : '' }}" class="form-control name check">
                        @if ($errors->first('name'))
                            <div class="error error-be">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class="form-group">
                        <input type="number" id="add_price" name="add_price" min=0 placeholder="Giá cộng thêm" value="{{ old('add_price') ? old('add_price') : '' }}" class="form-control add_price check">
                        @if ($errors->first('add_price'))
                        <div class="error error-be">{{ $errors->first('add_price') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-group-button">
                        <button class="create"><i class="fas fa-plus"></i></button>
                        <button class="delete"><i class="fas fa-times"></i></button>
                        <button class="edit display-none"><i class="fas fa-pen"></i></button>
                        <button data-url="{{ route('restaurant.menu.itemStore') }}" class="save"><i class="fas fa-check"></i></button>
                    </div>
                </div>
            </div>`;

        function html_yes_item(items) {
            let html = '';
            for (let x in items) {
                html += `<div class="row row-item">
                            <input type="hidden" class="id" name="id" value="${items[x].id}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="name" disabled name="name" placeholder="Tên" value="${items[x].name}" class="form-control name check">
                                    @if ($errors->first('name'))
                                        <div class="error error-be">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class = "col-md-3">
                                <div class="form-group">
                                    <input type="number" id="add_price" disabled name="add_price" min=0 placeholder="Giá cộng thêm" value="${items[x].add_price}" class="form-control add_price check">
                                    @if ($errors->first('add_price'))
                                    <div class="error error-be">{{ $errors->first('add_price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-button">
                                    <button class="create display-none"><i class="fas fa-plus"></i></button>
                                    <button class="delete display-none"><i class="fas fa-times"></i></button>
                                    <button class="edit"><i class="fas fa-pen"></i></button>
                                    <button data-url="{{route('restaurant.menu.itemStore')}}" class="save display-none"><i class="fas fa-check"></i></button>
                                </div>
                            </div>
                        </div>`
            }
            return html;
        };

        $(document).on('click', '.show-item', function() {
            let menu_id = $(this).data('menu_id');
            let menu_name = $(this).data('menu_name');
            let menu_describe = $(this).data('menu_describe');
            $.ajax({
                type: "POST",
                url: `{{route('restaurant.menu.itemShow')}}`,
                data: {
                    menu_id: menu_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#modalFormItem .menu-name').text(menu_name + ' (' + menu_describe + ')');
                        $('#modalFormItem #menu_id').val(menu_id);
                        if (response.items.length > 0) {
                            $('#modalFormItem .modal-body').html(html_yes_item(response.items));
                        } else {
                            $('#modalFormItem .modal-body').html(html_no_item);
                        }
                        checkCreateItem();
                    }
                },
                error: function(xhr) {

                }
            })
        });

        $(document).on('click', '#modalFormItem .create', function() {
            let parent = $(this).closest('#modalFormItem .modal-body');
            let father = parent.parent();
            parent.find('.delete').addClass('display-none');
            $(this).addClass('display-none');
            parent.append(html_no_item);
        });
        $(document).on('click', '#modalFormItem .edit', function() {
            let parent = $(this).closest('.row-item');
            let name = parent.find('.name');
            let add_price = parent.find('.add_price');
            let save = parent.find('.save');
            name.prop('disabled', false);
            add_price.prop('disabled', false);
            save.removeClass('display-none');
            save.attr('data-url', `{{route('restaurant.menu.itemUpdate')}}`);
            $(this).addClass('display-none');
        });
        $(document).on('click', '#modalFormItem .save', function() {
            let save = $(this);
            let parent = $(this).closest('.row-item');
            let edit = parent.find('.edit');
            let id = parent.find('.id');
            let name = parent.find('.name');
            let add_price = parent.find('.add_price');
            let url = save.data('url');
            let menu_id = $('#modalFormItem #menu_id');
            console.log(name.val(), add_price.val(), menu_id.val());
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    id: id.val(),
                    name: name.val(),
                    menu_id: menu_id.val(),
                    add_price: add_price.val(),
                },
                success: function(response) {
                    if (response.code == 200) {
                        name.val(response.data.name);
                        name.prop('disabled', true);
                        add_price.prop('disabled', true);
                        edit.removeClass('display-none');
                        save.addClass('display-none');
                        toastr.success('Cập thật thành công', {
                            timeOut: 5000
                        });
                        if (!id.val()) {
                            name.before(`<input type="hidden" class="id" name="id" value="` + response.data.id + `">`);
                        }
                    } else {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Thất bại', {
                        timeOut: 5000
                    })
                    if (xhr.responseJSON.errors.name) {
                        name.after(`<div class="error error-be">` + xhr.responseJSON.errors.name + `</div>`);
                        save.addClass('disabledbutton')
                    }
                }
            })
        })

        $(document).on('click', '#modalFormItem .delete', function() {
            let parent = $(this).closest('.row-item');
            let id = parent.find('.id');
            let father = $(this).closest('#modalFormItem .modal-body');
            let grandfather = father.parent();
            if (id.val()) {
                $.ajax({
                    type: "POST",
                    url: `{{route('restaurant.menu.itemDestroy')}}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        id: id.val(),
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            parent.remove();
                            if (father.find('.row-item').length < 1) {
                                father.append(html_no);
                            }
                            checkCreateItem();
                        } else {
                            toastr.error('Thất bại', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Thất bại', {
                            timeOut: 5000
                        })
                    }
                })
            } else {
                parent.remove();
                checkCreateItem();
            }
        })

        $(document).on('keyup', '#form-item input', function() {
            let parent = $(this).closest('.row-item');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('change', '#form-item input', function() {
            let parent = $(this).closest('.row-item');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })
    })
</script>
