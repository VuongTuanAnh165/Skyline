@if (!empty($breadcrumb) && is_array($breadcrumb))
    @foreach ($breadcrumb as $item)
        @if (!empty($item['title']) && !empty($item['url']))
            @if ($loop->last)
                <li class="nav-item d-none d-sm-inline-block active-link">{{ $item['title'] }}</li>
            @else
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{$item['url']}}">{{ $item['title'] }}</a>
                </li>
            @endif
        @endif
    @endforeach
@endif