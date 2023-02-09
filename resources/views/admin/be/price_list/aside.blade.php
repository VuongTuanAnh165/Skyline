@php
    $arg_price_list = array(
        'admin.price_list.index',
        'admin.price_list.create',
        'admin.price_list.show',
        'admin.price_list.edit',
    );
    $active = '';
    if ( in_array($name,$arg_price_list) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.price_list.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>
            Bảng giá
        </p>
    </a>
</li>