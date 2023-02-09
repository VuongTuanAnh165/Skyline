<script>
    $(document).ready(function() {
        function checkFullCreate() {
            $('.card-full').find('.create').eq($('.card-full').find('.create').length - 1).removeClass('display-none');
            $('.card-full').find('.delete').eq($('.card-full').find('.create').length - 1).removeClass('display-none');
            $('.card-full').find('.delete').eq(0).addClass('display-none');
        };
        checkFullCreate();

        function checkPartCreate() {
            $('.card-part').find('.create').eq($('.card-part').find('.create').length - 1).removeClass('display-none');
            $('.card-part').find('.delete').eq($('.card-part').find('.create').length - 1).removeClass('display-none');
            $('.card-part').find('.delete').eq(0).addClass('display-none');
        };
        checkPartCreate();

        function textHtmlFull(shift, work_type) {

            return `
                <div class = "card-item">
                    <div class="form-group">
                        <label for="name">Ca ${shift}</label>
                    </div>
                    <div class="row row-shift">
                        <input type="hidden" class="name" name="name" value="${shift}">
                        <input type="hidden" class="work_type" name="work_type" value="${work_type}">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.admin.shift.form.start') }}</label>
                                <input type="time" class="form-control start">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.admin.shift.form.end') }}</label>
                                <input type="time" class="form-control end">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group form-group-button">
                                <button class="create"><i class="fas fa-plus"></i></button>
                                <button class="delete"><i class="fas fa-times"></i></button>
                                <button class="edit display-none"><i class="fas fa-pen"></i></button>
                                <button data-url="{{route('restaurant.shift.store')}}" class="save"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `
        }
        $(document).on('click','.create', function() {
            let parent = $(this).closest('.card-body');
            let father = parent.parent();
            parent.find('.delete').addClass('display-none');
            $(this).addClass('display-none');
            parent.append(textHtmlFull(parent.find('.row-shift').length + 1, father.data('work_type')));
        });
        $(document).on('click','.edit', function() {
            let parent = $(this).closest('.row-shift');
            let start = parent.find('.start');
            let end = parent.find('.end');
            let save = parent.find('.save');
            start.prop('disabled', false);
            end.prop('disabled', false);
            save.removeClass('display-none');
            save.attr('data-url', `{{route('restaurant.shift.update')}}`);
            $(this).addClass('display-none');
        });
        $(document).on('click','.save', function() {
            let save = $(this);
            let parent = $(this).closest('.row-shift');
            let edit = parent.find('.edit');
            let id = parent.find('.id');
            let name = parent.find('.name');
            let start = parent.find('.start');
            let end = parent.find('.end');
            let work_type = parent.find('.work_type');
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
                    start: start.val(),
                    end: end.val(),
                    work_type: work_type.val(),
                },
                success: function(response) {
                    if (response.code == 200) {
                        start.val(response.data.start);
                        end.val(response.data.end);
                        start.prop('disabled', true);
                        end.prop('disabled', true);
                        edit.removeClass('display-none');
                        save.addClass('display-none');
                        toastr.success('Cập thật thành công', {
                            timeOut: 5000
                        });
                        if (!id.val()) {
                            work_type.before(`<input type="hidden" class="id" name="id" value="` + response.data.id + `">`);
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
                    if(xhr.responseJSON.errors.end) {
                        end.after(`<div class="error error-be">`+xhr.responseJSON.errors.end+`</div>`);
                        save.addClass('disabledbutton')
                    }
                    if(xhr.responseJSON.errors.start) {
                        start.after(`<div class="error error-be">`+xhr.responseJSON.errors.start+`</div>`);
                        save.addClass('disabledbutton')
                    }
                }
            })
        })

        $(document).on('click','.delete', function() {
            let parent = $(this).closest('.card-item');
            let id = parent.find('.id');
            let father = $(this).closest('.card-body');
            let grandfather = father.parent();
            if(id.val()) {
                $.ajax({
                    type: "POST",
                    url: `{{route('restaurant.shift.destroy')}}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        id: id.val(),
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            parent.remove();
                            if(father.find('.row-shift').length < 1) {
                                father.append(textHtmlFull(father.find('.row-shift').length + 1, grandfather.data('work_type')));
                            }
                            checkFullCreate();
                            checkPartCreate();
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
                checkFullCreate();
                checkPartCreate();
            }
        })

        $(document).on('keyup','.card-full input', function() {
            let parent = $(this).closest('.row-shift');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('change','.card-full input', function() {
            let parent = $(this).closest('.row-shift');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('keyup','.card-part input', function() {
            let parent = $(this).closest('.row-shift');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })

        $(document).on('change','.card-part input', function() {
            let parent = $(this).closest('.row-shift');
            let save = parent.find('.save');
            save.removeClass('disabledbutton');
            parent.find('.error.error-be').text('');
        })
    })
</script>