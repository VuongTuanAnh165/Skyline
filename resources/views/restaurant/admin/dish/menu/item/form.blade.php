<div class="modal fade" id="modalFormItem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;" role="document">
        <div class="modal-content">
            <div class="form-customer" id="form-item" data-id="">
                <input type="hidden" name="menu_id" id="menu_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title title-form-item">Lựa chọn menu: <span class="menu-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@if (
    $errors->first('amount_personnel') ||
        $errors->first('work_type') ||
        $errors->first('wage') ||
        $errors->first('name'))
    @section('addjs')
        <script>
            // $('#modalFormitem').modal('show');
        </script>
    @stop
@endif
