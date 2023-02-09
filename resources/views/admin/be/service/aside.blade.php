@php
    $arg_service = array(
        'admin.service.index',
        'admin.service.create',
        'admin.service.edit',
        'admin.service_group.show',
        'admin.service_group.index',
        'admin.service_type.index',
        'admin.service_type.updateShowHome',
        'admin.service_type.create',
        'admin.service_type.edit',
    );
    $active = '';
    if ( in_array($name,$arg_service) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.service.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fab fa-servicestack"></i>
        <p>
            {{ __('messages.admin.service.title') }}
        </p>
    </a>
</li>