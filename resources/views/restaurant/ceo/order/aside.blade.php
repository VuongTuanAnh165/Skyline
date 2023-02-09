@php
    $arg_order = array(
        'ceo.order.index',
        'ceo.order.show',
    );
    $active = '';
    if ( in_array($name,$arg_order) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('ceo.order.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-receipt"></i>
        <p>
            Hóa đơn
        </p>
    </a>
</li>