@php
    $arg_branch = array(
        'restaurant.branch.index',
        'restaurant.branch.create',
        'restaurant.branch.show',
        'restaurant.branch.edit',
        'restaurant.table.index',
    );
    $active = '';
    if ( in_array($name,$arg_branch) ) {
        $active = 'active';
    }
@endphp
<li class="nav-item">
    <a href="{{ route('restaurant.branch.index') }}" class="nav-link {{ $active }}">
        <i class="nav-icon fas fa-code-branch"></i>
        <p>
            {{ __('messages.admin.branch.title') }}
        </p>
    </a>
</li>