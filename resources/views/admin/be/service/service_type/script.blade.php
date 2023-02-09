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

        function checkCreate() {
            $('#form-service_charge').find('.create').eq($('#form-service_charge').find('.create').length - 1).removeClass('display-none');
            $('#form-service_charge').find('.delete').eq($('#form-service_charge').find('.create').length - 1).removeClass('display-none');
            $('#form-service_charge').find('.delete').eq(0).addClass('display-none');
        };
        checkCreate();

        var html_no = `<div class="row row-service_charge">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="month">{{ __('messages.admin.service.table.month') }}</label>
                                <input type="text" id="month" name="month" placeholder="{{ __('messages.admin.service.table.month') }}" value="{{ old('month') ? old('month') : '' }}" class="form-control month">
                                @if ($errors->first('month'))
                                <div class="error error-be">{{ $errors->first('month') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="price">{{ __('messages.admin.service.table.price') }}</label>
                                <input type="number" id="price" name="price" placeholder="{{ __('messages.admin.service.table.price') }}" value="{{ old('price') ? old('price') : '' }}" class="form-control price">
                                @if ($errors->first('price'))
                                <div class="error error-be">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-button">
                                <button class="create"><i class="fas fa-plus"></i></button>
                                <button class="delete"><i class="fas fa-times"></i></button>
                                <button class="edit display-none"><i class="fas fa-pen"></i></button>
                                <button data-url="{{route('admin.service.storeServiceCharge')}}" class="save"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>`;

        function html_yes(service_charges) {
            let html = '';
            for (let x in service_charges) {
                html += `<div class="row row-service_charge">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="month">{{ __('messages.admin.service.table.month') }}</label>
                                <input type="hidden" class="id" name="id" value="${service_charges[x].id}">
                                <input type="text" id="month" disabled name="month" placeholder="{{ __('messages.admin.service.table.month') }}" value="${service_charges[x].month}" class="form-control month">
                                @if ($errors->first('month'))
                                <div class="error error-be">{{ $errors->first('month') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="price">{{ __('messages.admin.service.table.price') }}</label>
                                <input type="number" id="price" disabled name="price" placeholder="{{ __('messages.admin.service.table.price') }}" value="${service_charges[x].price}" class="form-control price">
                                @if ($errors->first('price'))
                                <div class="error error-be">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-button">
                                <button class="create display-none"><i class="fas fa-plus"></i></button>
                                <button class="delete display-none"><i class="fas fa-times"></i></button>
                                <button class="edit"><i class="fas fa-pen"></i></button>
                                <button data-url="{{route('admin.service.storeServiceCharge')}}" class="save display-none"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>`
            }
            return html;
        };
        $(document).on('click', '.show-service', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#service_type_id').val(id);
            $('.title-form-service_charge').text(name);
            $.ajax({
                type: "POST",
                url: `{{route('admin.service.show')}}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response.code == 200) {
                        if (response.service_charges.length > 0) {
                            $('.modal-body').html(html_yes(response.service_charges));
                        } else {
                            $('.modal-body').html(html_no);
                        }
                        checkCreate();
                    }
                },
                error: function(xhr) {

                }
            })
        });

        $(document).on('click', '.create', function() {
            let parent = $(this).closest('.modal-body');
            let father = parent.parent();
            parent.find('.delete').addClass('display-none');
            $(this).addClass('display-none');
            parent.append(html_no);
        });
        $(document).on('click', '.edit', function() {
            let parent = $(this).closest('.row-service_charge');
            let month = parent.find('.month');
            let price = parent.find('.price');
            let save = parent.find('.save');
            month.prop('disabled', false);
            price.prop('disabled', false);
            save.removeClass('display-none');
            save.attr('data-url', `{{route('admin.service.updateServiceCharge')}}`);
            $(this).addClass('display-none');
        });
        $(document).on('click', '.save', function() {
            let save = $(this);
            let parent = $(this).closest('.row-service_charge');
            let edit = parent.find('.edit');
            let id = parent.find('.id');
            let service_type_id = $('#service_type_id');
            let month = parent.find('.month');
            let price = parent.find('.price');
            let url = save.data('url');
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    id: id.val(),
                    service_type_id: service_type_id.val(),
                    month: month.val(),
                    price: price.val(),
                },
                success: function(response) {
                    if (response.code == 200) {
                        month.val(response.data.month);
                        price.val(response.data.price);
                        month.prop('disabled', true);
                        price.prop('disabled', true);
                        edit.removeClass('display-none');
                        save.addClass('display-none');
                        toastr.success('Cập thật thành công', {
                            timeOut: 5000
                        });
                        if (!id.val()) {
                            month.before(`<input type="hidden" class="id" name="id" value="` + response.data.id + `">`);
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
                    if (xhr.responseJSON.errors.price) {
                        price.after(`<div class="error error-be">` + xhr.responseJSON.errors.price + `</div>`);
                        save.addClass('disabledbutton')
                    }
                    if (xhr.responseJSON.errors.month) {
                        month.after(`<div class="error error-be">` + xhr.responseJSON.errors.month + `</div>`);
                        save.addClass('disabledbutton')
                    }
                }
            })
        })

        $(document).on('click', '.delete', function() {
            let parent = $(this).closest('.row-service_charge');
            let id = parent.find('.id');
            let father = $(this).closest('.modal-body');
            let grandfather = father.parent();
            if (id.val()) {
                $.ajax({
                    type: "POST",
                    url: `{{route('admin.service.destroyServiceCharge')}}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        id: id.val(),
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            parent.remove();
                            if (father.find('.row-service_charge').length < 1) {
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

        $(document).on('keyup', '#form-service_charge input', function() {
            let parent = $(this).closest('.row-service_charge');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('change', '#form-service_charge input', function() {
            let parent = $(this).closest('.row-service_charge');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })
    })
</script>