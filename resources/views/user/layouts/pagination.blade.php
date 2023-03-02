@if ($paginator->hasPages())
<div class="pagination__area bg__gray--color">
    <nav class="pagination justify-content-center">
        <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="pagination__list page-item disabled">
                    <a href="#" class="pagination__item--arrow  link page-link" tabindex="-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                        </svg>
                        <span class="visually-hidden">page left arrow</span>
                    </a>
                <li>
            @else
                <li class="page-item pagination__list">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination__item--arrow  link page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                        </svg>
                        <span class="visually-hidden">page left arrow</span>
                    </a>
                <li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination__list page-item disabled"><span class="pagination__item pagination__item--current">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__list page-item active">
                                <a href="shop.html" class="pagination__item link page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="pagination__list page-item">
                                <a href="{{ $url }}" class="pagination__item link page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="pagination__list page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination__item--arrow  link page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100" />
                        </svg>
                        <span class="visually-hidden">page right arrow</span>
                    </a>
                <li>
            @else
                <li class="pagination__list page-item disabled">
                    <a href="#" class="pagination__item--arrow  link page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100" />
                        </svg>
                        <span class="visually-hidden">page right arrow</span>
                    </a>
                <li>
            @endif
        </ul>
    </nav>
</div>
@endif