@extends('user.my_account.index')
@section('title', 'Đơn hàng của bạn')
@section('addcss')
    <link rel="stylesheet" href="{{ asset('css/web_user/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template_web_admin/plugins/codemirror/theme/monokai.css') }}">
@stop
@section('content_my_account')
    <div class="account__wrapper">
        <div class="account__content">
            <h2 class="account__content--title h3 mb-20">Đơn hàng của bạn</h2>
            <div class="account__table--area">
                <table class="account__table">
                    <thead class="account__table--header">
                    <tr class="account__table--header__child">
                        <th class="account__table--header__child--items">Mã hóa đơn</th>
                        <th class="account__table--header__child--items">Ngày tạo</th>
                        <th class="account__table--header__child--items">Trạng thái thanh toán</th>
                        <th class="account__table--header__child--items">Tình trạng đơn hàng</th>
                        <th class="account__table--header__child--items">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody class="account__table--body mobile__none">
                    @foreach ($orders as $order)
                        <tr class="account__table--body__child">
                            <td class="account__table--body__child--items"><a data-bs-toggle="modal"
                                                                              data-bs-target="#detailOrderModal"
                                                                              class="link_detail_order"
                                                                              href="javascript:void(0)">{{ $order->order_id }}</a>
                            </td>
                            <td class="account__table--body__child--items">{{ $order->implementation_date }}</td>
                            <td class="account__table--body__child--items">{{ $status_payment[$order->status_payment] }}
                            </td>
                            <td class="account__table--body__child--items">
                                <ul>
                                    @foreach ($order->status as $item)
                                        <li>{{ $status[$item[0]] }} - ({{ $item[1] }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="account__table--body__child--items"><b>{{ number_format($order->total_money) }}
                                    VND</b>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tbody class="account__table--body mobile__block">
                    @foreach ($orders as $order)
                        <tr class="account__table--body__child">
                            <td class="account__table--body__child--items">
                                <strong>Mã hóa đơn</strong>
                                <span>{{ $order->order_id }}</span>
                            </td>
                            <td class="account__table--body__child--items">
                                <strong>Ngày tạo</strong>
                                <span>{{ $order->implementation_date }}</span>
                            </td>
                            <td class="account__table--body__child--items">
                                <strong>Trạng thái thanh toán</strong>
                                <span>{{ $status_payment[$order->status_payment] }}</span>
                            </td>
                            <td class="account__table--body__child--items">
                                <strong>Tình trạng đơn hàng</strong>
                                @foreach ($order->status as $item)
                                    <span>{{ $status[$item[0]] }} - ({{ $item[1] }})</span><br>
                                @endforeach
                            </td>
                            <td class="account__table--body__child--items">
                                <strong>Thành tiền</strong>
                                <span>{{ number_format($order->total_money) }} VND</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailOrderModal" tabindex="-1" aria-labelledby="detailOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title account__content--title" id="detailOrderModalLabel">Chi tiết đơn hàng: <span
                            class="order_id text-danger"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-order-detail">

                    </div>
                    <div id="modal-order-rating">
                        <div class="container-fluid">
                            <div class="title-product d-flex align-items-center mb-40">
                                <h2 class="cart__title mr-4">Đánh giá</h2>
                            </div>
                            <div class="form-group rating mb-0">
                                @for ($i = 5; $i > 0; $i--)
                                    <input type="radio" id="star{{$i}}" name="star" value="{{$i}}" class="check"/>
                                    <label class="star" for="star{{$i}}" title="{{$i}} sao" aria-hidden="true"></label>
                                @endfor
                            </div>
                            <div class="error error-be text-center error-star"></div>
                            <div class="form-group">
                                <label for="comment">Bình luận: <span class="comment"></span></label>
                                <textarea class="form-control comment check" rows="5" id="comment"
                                          name='comment'></textarea>
                                <div class="error error-be error-comment"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btn-rating" class="btn btn-primary">Gửi</div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('user.partials.script.toastr')
    @endif
    <script src="{{ asset('js/web_user/account.js') }}"></script>
    @include('user.my_account.script.script_order')
@stop
