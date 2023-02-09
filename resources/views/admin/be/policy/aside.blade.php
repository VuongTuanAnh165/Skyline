@php
    $arg_policy = array(
        'admin.policy.index',
        'admin.policy.create',
        'admin.policy.show',
        'admin.policy.edit',
    );
    $active = '';
    if ( in_array($name,$arg_policy) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.policy.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon far fa-file-powerpoint"></i>
        <p>
            {{ __('messages.admin.policy.title') }}
        </p>
    </a>
</li>