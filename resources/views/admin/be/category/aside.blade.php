@php
    $arg_category_home = array(
        'admin.category.index',
    );
    $active = '';
    if ( in_array($name,$arg_category_home) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.category.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            {{ __('messages.admin.category_home.title') }}
        </p>
    </a>
</li>