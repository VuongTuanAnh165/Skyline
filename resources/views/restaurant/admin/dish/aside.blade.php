@php
    $arg_dish = array(
        'restaurant.dish.index',
        'restaurant.dish.create',
        'restaurant.dish.show',
        'restaurant.dish.edit',
        'restaurant.category.index',
        'restaurant.menu',
    );
    $active = '';
    if ( in_array($name,$arg_dish) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.dish.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-satellite-dish"></i>
        <p>
            {{ $messages['dish']['title'] }}
        </p>
    </a>
</li>