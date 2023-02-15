@php
    $arg_dish = array(
        'sell.restaurant.eat.index',
        'sell.restaurant.eat.edit',
        'sell.restaurant.eat.payment',
    );
    $active = '';
    if ( in_array($name,$arg_dish) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item {{ $active }}">
    <a class="nav-link" href="{{ route('sell.restaurant.eat.index') }}">
        <i class="mdi mdi-grid-large"></i>
        <span>Ăn tại quán</span>
    </a>
</li>