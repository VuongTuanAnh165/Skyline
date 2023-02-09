@php
    $arg_post = array(
        'restaurant.post.index',
        'restaurant.post.create',
        'restaurant.post.show',
        'restaurant.post.edit',
    );
    $active = '';
    if ( in_array($name,$arg_post) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.post.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fab fa-usps"></i>
        <p>
            {{ __('messages.admin.post.title') }}
        </p>
    </a>
</li>