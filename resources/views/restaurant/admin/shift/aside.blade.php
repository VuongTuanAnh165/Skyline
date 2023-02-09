@php
    $arg_shift = array(
        'restaurant.shift.index',
    );
    $active = '';
    if ( in_array($name,$arg_shift) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.shift.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon far fa-clock"></i>
        <p>
            {{ __('messages.admin.shift.title') }}
        </p>
    </a>
</li>