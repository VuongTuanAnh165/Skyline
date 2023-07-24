<!-- Modal -->
<div class="modal fade" id="detailOrderModal" tabindex="-1" aria-labelledby="detailOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailOrderModalLabel">Chi tiết đơn hàng: <span class="order_id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- cart section start -->
                <section class="cart__section section--padding">
                    <div class="container-fluid">
                        <div class="cart__section--inner">
                            @if (count($data->detail) > 0)
                                <div class="cart-restaurant mb-60">
                                    <div class="title-product d-flex align-items-center mb-40">
                                        <h2 class="cart__title mr-4">{{ $data->restaurant_name }}</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="cart__table">
                                                <table class="cart__table--inner">
                                                    <thead class="cart__table--header">
                                                        <tr class="cart__table--header__items">
                                                            <th class="cart__table--header__list">Phân loại</th>
                                                            <th class="cart__table--header__list">Số lượng</th>
                                                            <th class="cart__table--header__list">Tổng cộng</th>
                                                            <th class="cart__table--header__list"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="cart__table--body">
                                                        @foreach ($data->detail as $value)
                                                            @php
                                                                $dish = App\Models\Dish::find($value[0]);
                                                            @endphp
                                                            <tr class="cart__table--body__items">
                                                                <td class="cart__table--body__list">
                                                                    <div
                                                                        class="cart__product d-flex align-items-center">
                                                                        <div class="cart__thumbnail">
                                                                            <a
                                                                                href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                                                                <img class="border-radius-5"
                                                                                    src="{{ !empty($dish->image) ? asset('storage/' . $dish->image[0]) : asset('img/background_default.jpg') }}"
                                                                                    alt="cart-product">
                                                                            </a>
                                                                        </div>
                                                                        <div class="cart__content">
                                                                            <h3 class="cart__content--title h4"><a
                                                                                    href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">{{ $dish->name }}</a>
                                                                            </h3>
                                                                            <span class="cart__content--variant">Giá:
                                                                                <span
                                                                                    class="cart__price">{{ number_format($dish->price) }}
                                                                                    VND</span></span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                {{-- <td class="cart__table--body__list">
                                                                    @php
                                                                        $detail_item_logs = \App\Models\DetailItemLog::where('detail_order_log_id', $detail_order_log->id)
                                                                            ->groupBy('item')
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($detail_item_logs as $detail_item_log)
                                                                        @if (!empty($detail_item_log->item))
                                                                            @foreach ($detail_item_log->item as $item)
                                                                                @php
                                                                                    $menu = App\Models\Menu::select('name')
                                                                                        ->where('id', $item[0])
                                                                                        ->first();
                                                                                @endphp
                                                                                <div class="cart__price">
                                                                                    <h3 class="cart__content--title h4">
                                                                                        {{ $menu->name }}: </h3>
                                                                                    @if (is_array($item[1]))
                                                                                        @foreach ($item[1] as $value)
                                                                                            @php
                                                                                                $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                                    ->where('id', $value)
                                                                                                    ->first();
                                                                                            @endphp
                                                                                            @if ($menu_item)
                                                                                                <span
                                                                                                    class="cart__content--variant cart__content">
                                                                                                    <ul>
                                                                                                        <li>
                                                                                                            {{ $menu_item->name }}:
                                                                                                            <span
                                                                                                                class="cart__price">
                                                                                                                +
                                                                                                                {{ number_format($menu_item->add_price) }}
                                                                                                                VND</span>
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                class="value_price"
                                                                                                                value="{{ $menu_item->add_price }}">
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="cart__content--variant cart__content">Không
                                                                                                    có</span>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @else
                                                                                        @php
                                                                                            $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                                ->where('id', $item[1])
                                                                                                ->first();
                                                                                        @endphp
                                                                                        @if ($menu_item)
                                                                                            <span
                                                                                                class="cart__content--variant cart__content">
                                                                                                <ul>
                                                                                                    <li>
                                                                                                        {{ $menu_item->name }}:
                                                                                                        <span
                                                                                                            class="cart__price">
                                                                                                            +
                                                                                                            {{ number_format($menu_item->add_price) }}
                                                                                                            VND</span>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            class="value_price"
                                                                                                            value="{{ $menu_item->add_price }}">
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </span>
                                                                                        @else
                                                                                            <span
                                                                                                class="cart__content--variant cart__content">Không
                                                                                                có</span>
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="cart__price">Không có</div>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td class="cart__table--body__list">
                                                                    <div class="quantity__box">
                                                                        <button type="button"
                                                                            class="quantity__value quickview__value--quantity decrease"
                                                                            aria-label="quantity value"
                                                                            value="Decrease Value">-</button>
                                                                        <label>
                                                                            <input type="number"
                                                                                class="quantity__number quickview__value--number"
                                                                                value="{{ $detail_order_log->quantity }}"
                                                                                min="1" data-counter />
                                                                        </label>
                                                                        <button type="button"
                                                                            class="quantity__value quickview__value--quantity increase"
                                                                            aria-label="quantity value"
                                                                            value="Increase Value">+</button>
                                                                    </div>
                                                                </td>
                                                                <td class="cart__table--body__list">
                                                                    <span class="cart__price end">£130.00</span>
                                                                </td> --}}
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- cart section end -->
            </div>
        </div>
    </div>
</div>
