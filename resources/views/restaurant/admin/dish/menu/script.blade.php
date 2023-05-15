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
        function checkCreate() {
            $('#form-menu').find('.create').eq($('#form-menu').find('.create').length - 1).removeClass('display-none');
            $('#form-menu').find('.delete').eq($('#form-menu').find('.create').length - 1).removeClass('display-none');
            $('#form-menu').find('.delete').eq(0).addClass('display-none');
        };
        checkCreate();

        var html_no = `<div class="row row-menu">
                        <div class="col-md-3">
                            <div class="form-group ">
                                <input type="text" id="name" name="name" placeholder="Tên" value="{{ old('name') ? old('name') : '' }}" class="form-control name">
                                @if ($errors->first('name'))
                                <div class="error error-be">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <input type="text" id="describe" name="describe" placeholder="Mô tả" value="{{ old('describe') ? old('describe') : '' }}" class="form-control describe">
                                @if ($errors->first('describe'))
                                <div class="error error-be">{{ $errors->first('describe') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <input type="checkbox" id="required" name="required" value=1 class="form-control required_check">
                                <label for="required">Bắt buộc ?</label>
                                @if ($errors->first('required'))
                                <div class="error error-be">{{ $errors->first('required') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <input type="checkbox" id="multiple" name="multiple" value=1 class="form-control multiple_check">
                                <label for="multiple">Chọn nhiều ?</label>
                                @if ($errors->first('multiple'))
                                <div class="error error-be">{{ $errors->first('multiple') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-group-button">
                                <button class="create"><i class="fas fa-plus"></i></button>
                                <button class="delete"><i class="fas fa-times"></i></button>
                                <button class="edit display-none"><i class="fas fa-pen"></i></button>
                                <button data-url="{{route('restaurant.dish.storeMenu')}}" class="save"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>`;

        function html_yes(menus) {
            let html = '';
            for (let x in menus) {
                let check_required = menus[x].required == 1 ? 'checked' : '';
                let check_multiple = menus[x].multiple == 1 ? 'checked' : '';
                html += `<div class="row row-menu">
                        <div class="col-md-3">
                            <div class="form-group ">
                                <input type="hidden" class="id" name="id" value="${menus[x].id}">
                                <input type="text" id="name" disabled name="name" placeholder="Tên" value="${menus[x].name}" class="form-control name">
                                @if ($errors->first('name'))
                                <div class="error error-be">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <input type="text" id="describe" disabled name="describe" placeholder="Mô tả" value="${menus[x].describe}" class="form-control describe">
                                @if ($errors->first('describe'))
                                <div class="error error-be">{{ $errors->first('describe') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <input type="checkbox" id="required" disabled name="required" value=1 class="form-control required_check" ${check_required}>
                                <label for="required">Bắt buộc ?</label>
                                @if ($errors->first('required'))
                                <div class="error error-be">{{ $errors->first('required') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <input type="checkbox" id="multiple" disabled name="multiple" value=1 class="form-control multiple_check" ${check_multiple}>
                                <label for="multiple">Chọn nhiều ?</label>
                                @if ($errors->first('multiple'))
                                <div class="error error-be">{{ $errors->first('multiple') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-group-button">
                                <button class="create display-none"><i class="fas fa-plus"></i></button>
                                <button class="delete display-none"><i class="fas fa-times"></i></button>
                                <button class="edit"><i class="fas fa-pen"></i></button>
                                <button data-url="{{route('restaurant.dish.storeMenu')}}" class="save display-none"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>`
            }
            return html;
        };
        $(document).on('click', '.show-dish-menu', function() {
            $.ajax({
                type: "POST",
                url: `{{route('restaurant.dish.showMenu')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.code == 200) {
                        if (response.menus.length > 0) {
                            $('#modalFormMenu .modal-body').html(html_yes(response.menus));
                        } else {
                            $('#modalFormMenu .modal-body').html(html_no);
                        }
                        checkCreate();
                    }
                },
                error: function(xhr) {

                }
            })
        });

        $(document).on('click', '#modalFormMenu .create', function() {
            let parent = $(this).closest('#modalFormMenu .modal-body');
            let father = parent.parent();
            parent.find('.delete').addClass('display-none');
            $(this).addClass('display-none');
            parent.append(html_no);
        });
        $(document).on('click', '#modalFormMenu .edit', function() {
            let parent = $(this).closest('.row-menu');
            let name = parent.find('.name');
            let describe = parent.find('.describe');
            let required = parent.find('.required_check');
            let multiple = parent.find('.multiple_check');
            let save = parent.find('.save');
            name.prop('disabled', false);
            describe.prop('disabled', false);
            required.prop('disabled', false);
            multiple.prop('disabled', false);
            save.removeClass('display-none');
            save.attr('data-url', `{{route('restaurant.dish.updateMenu')}}`);
            $(this).addClass('display-none');
        });
        $(document).on('click', '#modalFormMenu .save', function() {
            let save = $(this);
            let parent = $(this).closest('.row-menu');
            let edit = parent.find('.edit');
            let id = parent.find('.id');
            let name = parent.find('.name');
            let describe = parent.find('.describe');
            let required = parent.find('.required_check:checked');
            let multiple = parent.find('.multiple_check:checked');
            let url = save.data('url');
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    id: id.val(),
                    name: name.val(),
                    describe: describe.val(),
                    required: required.val(),
                    multiple: multiple.val(),
                },
                success: function(response) {
                    if (response.code == 200) {
                        name.val(response.data.name);
                        name.prop('disabled', true);
                        describe.prop('disabled', true);
                        required.prop('disabled', true);
                        multiple.prop('disabled', true);
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

        $(document).on('click', '#modalFormMenu .delete', function() {
            let parent = $(this).closest('.row-menu');
            let id = parent.find('.id');
            let father = $(this).closest('#modalFormMenu .modal-body');
            let grandfather = father.parent();
            if (id.val()) {
                $.ajax({
                    type: "POST",
                    url: `{{route('restaurant.dish.destroyMenu')}}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        id: id.val(),
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            parent.remove();
                            if (father.find('.row-menu').length < 1) {
                                father.append(html_no);
                            }
                            checkCreate();
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
                checkCreate();
            }
        })

        $(document).on('keyup', '#form-menu input', function() {
            let parent = $(this).closest('.row-menu');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('change', '#form-menu input', function() {
            let parent = $(this).closest('.row-menu');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })
    })
</script>