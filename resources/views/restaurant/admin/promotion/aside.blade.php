@php
    $arg_promotion = array(
        'restaurant.promotion.index',
        'restaurant.promotion.create',
        'restaurant.promotion.show',
        'restaurant.promotion.edit',
    );
    $active = '';
    if ( in_array($name,$arg_promotion) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.promotion.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-percent"></i>
        <p>
            {{ __('messages.admin.promotion.title') }}
        </p>
    </a>
</li>