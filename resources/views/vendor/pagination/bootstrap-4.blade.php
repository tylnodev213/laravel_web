@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ \Request::url().'?'.getRequest(request()->except('page')) }}" rel="prev" aria-label="@lang('pagination.first')">&laquo;</a>
                </li>
            @endif
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">Prev</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl().getRequest(request()->except('page')) }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url.getRequest(request()->except('page')) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl().getRequest(request()->except('page')) }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">Next</span>
                </li>
            @endif
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ \Request::url().'?page='.$paginator->lastPage().getRequest(request()->except('page')) }}" rel="last" aria-label="@lang('pagination.last')">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                @endif
        </ul>
    </nav>
@endif
