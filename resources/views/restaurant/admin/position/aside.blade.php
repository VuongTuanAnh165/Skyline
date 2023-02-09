@php
    $arg_position = array(
        'restaurant.position.index',
        'restaurant.position.show',
    );
    $active = '';
    if ( in_array($name,$arg_position) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.position.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fab fa-creative-commons-by"></i>
        <p>
            {{ __('messages.admin.position.title') }}
        </p>
    </a>
</li>