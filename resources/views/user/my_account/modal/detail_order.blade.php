<section class="cart__section">
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
                                        <th class="cart__table--header__list">Sản phẩm</th>
                                        <th class="cart__table--header__list">Phân loại</th>
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
                                                                href="{{ route($url_show, ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">{{ $dish->name }} ({{ $value[1]  }})</a>
                                                        </h3>
                                                        <span class="cart__content--variant">Giá:
                                                            <span class="cart__price">{{ number_format($dish->price) }}VND</span>
                                                        </span>
                                                        <span class="cart__content--variant">chi nhánh số: {{ $data->branch_name }}</span>
                                                        <span class="cart__content--variant">địa chỉ: {{ $data->branch_address }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                @php
                                                    $check_null = true;
                                                @endphp
                                                @if($value[2] > 0)
                                                    @foreach($value[2] as $value_item)
                                                        @if (!empty($value_item))
                                                            @php
                                                                $check_null = false;
                                                            @endphp
                                                            @foreach($value_item as $item)
                                                                @php
                                                                    $menu = App\Models\Menu::select('name')->where('id', $item[0])->first();
                                                                @endphp
                                                                <div class="cart__price">
                                                                    <h3 class="cart__content--title h4">
                                                                        {{ $menu->name }}: </h3>
                                                                    @if (is_array($item[1]))
                                                                        @foreach ($item[1] as $item_value)
                                                                            @php
                                                                                $menu_item = App\Models\MenuItem::select('name', 'add_price')
                                                                                    ->where('id', $item_value)
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
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if($check_null)
                                                    <div class="cart__price">Không có</div>
                                                @endif
                                            </td>
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
