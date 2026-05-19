@if ($paginator->hasPages())
    <nav style="display: flex; justify-content: center; gap: 0.5rem; align-items: center;">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-outline" style="opacity: 0.3; cursor: not-allowed; padding: 0.5rem 1rem; font-size: 0.8rem;">&laquo; Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">&laquo; Prev</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="color: var(--text-muted); padding: 0.5rem;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Next &raquo;</a>
        @else
            <span class="btn btn-outline" style="opacity: 0.3; cursor: not-allowed; padding: 0.5rem 1rem; font-size: 0.8rem;">Next &raquo;</span>
        @endif
    </nav>
@endif
