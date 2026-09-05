@if ($paginator->hasPages())
    <div class="flex items-center gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-8 h-8 rounded border border-gray-200 text-gray-400 flex items-center justify-center cursor-not-allowed">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w-8 h-8 rounded border border-gray-200 text-gray-500 flex items-center justify-center hover:bg-gray-50 transition">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-8 h-8 rounded border border-gray-200 text-gray-500 flex items-center justify-center">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-8 h-8 rounded bg-blue-600 text-white font-semibold flex items-center justify-center">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 rounded border border-gray-200 text-gray-700 font-semibold flex items-center justify-center hover:bg-gray-50 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w-8 h-8 rounded border border-gray-200 text-gray-500 flex items-center justify-center hover:bg-gray-50 transition">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        @else
            <span class="w-8 h-8 rounded border border-gray-200 text-gray-400 flex items-center justify-center cursor-not-allowed">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        @endif
    </div>
@endif
