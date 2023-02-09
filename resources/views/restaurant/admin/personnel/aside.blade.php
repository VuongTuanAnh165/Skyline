@php
    $arg_personnel = array(
        'restaurant.personnel.index',
        'restaurant.personnel.create',
        'restaurant.personnel.show',
        'restaurant.personnel.edit',
    );
    $active = '';
    if ( in_array($name,$arg_personnel) ) {
        $active = 'active';
    }
    $route_personnel = $restaurant ? route('restaurant.personnel.index') : ($personnel ? route('restaurant.personnel.edit', ['id'=> $personnel->id]) : '');
@endphp
<li class="nav-item">
    <a href="{{ $route_personnel }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-people-carry"></i>
        <p>
            {{ __('messages.admin.personnel.title') }}
        </p>
    </a>
</li>