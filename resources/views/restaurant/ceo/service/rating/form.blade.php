<div class="modal fade" id="modalRating" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đánh giá <span class="text-red"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Dịch vụ: <span class="service_name text-red"></span></label>
                </div>
                <div class="form-group">
                    <label for="">Email đăng ký: <span class="email_register text-red"></span></label>
                </div>
                <input type="hidden" id="product_id" class="product_id" value="">
                <div class="form-group rating mb-0">
                    @for ($i = 5; $i > 0; $i--)
                        <input type="radio" id="star{{$i}}" name="star" value="{{$i}}" class="check" />
                        <label class="star" for="star{{$i}}" title="{{$i}} sao" aria-hidden="true"></label>
                    @endfor
                </div>
                <div class="error error-be text-center error-star"></div>
                <div class="form-group">
                    <label for="comment">Bình luận: <span class="comment"></span></label>
                    <textarea class="form-control comment check" rows="5" id="comment" name='comment'></textarea>
                    <div class="error error-be error-comment"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn-rating" class="btn btn-primary">Gửi</div>
            </div>
        </div>
    </div>
</div>
