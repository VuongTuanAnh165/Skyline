@php
    $arg_profile = array(
        'ceo.profile.show',
    );
    $active = '';
    if ( in_array($name,$arg_profile) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('ceo.profile.show') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Hồ sơ cá nhân
        </p>
    </a>
</li>