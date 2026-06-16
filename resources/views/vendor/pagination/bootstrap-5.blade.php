@if ($paginator->hasPages())
<div class="pagination-wrapper">

    {{-- Info text --}}
    <p class="pagination-info">
        عرض
        <strong>{{ $paginator->firstItem() }}</strong>
        –
        <strong>{{ $paginator->lastItem() }}</strong>
        من
        <strong>{{ $paginator->total() }}</strong>
        نتيجة
    </p>

    {{-- Page links --}}
    <ul class="pagination">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">
                    <i class="bi bi-chevron-right"></i>
                    السابق
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="bi bi-chevron-right"></i>
                    السابق
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)

            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array of links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    التالي
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">
                    التالي
                    <i class="bi bi-chevron-left"></i>
                </span>
            </li>
        @endif

    </ul>
</div>
@endif
