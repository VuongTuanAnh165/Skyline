@extends('user.my_account.index')
@section('title', 'Đơn hàng của bạn')
@section('addcss')

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
                                <td class="account__table--body__child--items">{{ $order->order_id }}</td>
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
                                <td class="account__table--body__child--items">{{ number_format($order->total_money) }} VND
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
@stop
@section('addjs')
    @if (session('success') || session('error'))
        @include('user.partials.script.toastr')
    @endif
@stop
