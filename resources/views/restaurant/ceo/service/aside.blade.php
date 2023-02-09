@php
    $arg_service = array(
        'ceo.service.index',
    );
    $active = '';
    if ( in_array($name,$arg_service) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('ceo.service.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fab fa-servicestack"></i>
        <p>
            Dịch vụ của tôi
        </p>
    </a>
</li>