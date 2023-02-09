@php
    $arg_promotion = array(
        'admin.promotion.index',
        'admin.promotion.create',
        'admin.promotion.show',
        'admin.promotion.edit',
    );
    $active = '';
    if ( in_array($name,$arg_promotion) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.promotion.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-percent"></i>
        <p>
            {{ __('messages.admin.promotion.title') }}
        </p>
    </a>
</li>