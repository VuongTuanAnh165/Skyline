@php
    $arg_help = array(
        'ceo.help.index',
    );
    $active = '';
    if ( in_array($name,$arg_help) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('ceo.help.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-question"></i>
        <p>
            Quản lý câu hỏi
        </p>
    </a>
</li>