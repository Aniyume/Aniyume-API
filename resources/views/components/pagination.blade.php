@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-1 mt-6 text-sm select-none">

    @if ($paginator->onFirstPage())
        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">‹</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="px-3 py-2 rounded-md hover:bg-gray-100 text-gray-700">‹</a>
    @endif
    @foreach ($paginator->onEachSide(2)->links()->elements as $element)

        @if (is_string($element))
            <span class="px-3 py-2 text-gray-400">…</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-2 rounded-md bg-blue-600 text-white font-medium">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-2 rounded-md hover:bg-gray-100 text-gray-700">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif

    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="px-3 py-2 rounded-md hover:bg-gray-100 text-gray-700">›</a>
    @else
        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">›</span>
    @endif

</nav>
@endif
