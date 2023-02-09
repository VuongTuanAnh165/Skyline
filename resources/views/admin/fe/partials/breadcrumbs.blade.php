<!-- breadcrumb content begin -->
<div class="uk-section uk-padding-remove-vertical in-liquid-breadcrumb">
    <div class="uk-container">
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <ul class="uk-breadcrumb">
                    @if (!empty($breadcrumb) && is_array($breadcrumb))
                        @foreach ($breadcrumb as $item)
                            @if (!empty($item['title']) && !empty($item['url']))
                                <li>
                                    <a href="{{$item['url']}}"><span>{{ $item['title'] }}</span></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb content end -->