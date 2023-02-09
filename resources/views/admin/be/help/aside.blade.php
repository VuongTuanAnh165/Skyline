@php
    $arg_help = array(
        'admin.help.index',
        'admin.help.create',
        'admin.help.show',
        'admin.help.edit',
    );
    $active = '';
    if ( in_array($name,$arg_help) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('admin.help.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-question"></i>
        <p>
            Câu hỏi
        </p>
    </a>
</li>