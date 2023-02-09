@php
    $arg_image = array(
        'admin.image.index',
    );
    $active = '';
    if ( in_array($name,$arg_image) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.image.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-image"></i>
        <p>
            {{ __('messages.admin.image.title') }}
        </p>
    </a>
</li>