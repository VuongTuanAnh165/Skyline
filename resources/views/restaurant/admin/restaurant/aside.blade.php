@php
    $arg_restaurant = array(
        'restaurant.restaurant.edit',
    );
    $active = '';
    if ( in_array($name,$arg_restaurant) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.restaurant.edit') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            {{ $messages }}
        </p>
    </a>
</li>