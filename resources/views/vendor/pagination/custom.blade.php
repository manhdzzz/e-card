@if ($paginator->hasPages())
    <div class="pagination">
        <span class="pag-info">
            Hiển thị {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} trong tổng số {{ $paginator->total() }} bản ghi
        </span>
        <div style="display:flex;align-items:center;gap:.7rem">
            <div class="pag-btns">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="pag-btn disabled"><i class="fa-solid fa-chevron-left" style="font-size:.65rem"></i></span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="pag-btn"><i class="fa-solid fa-chevron-left" style="font-size:.65rem"></i></a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="pag-btn disabled">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pag-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pag-btn">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="pag-btn"><i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i></a>
                @else
                    <span class="pag-btn disabled"><i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i></span>
                @endif
            </div>

            <select class="pag-select" onchange="window.location.href='{{ $paginator->path() }}?per_page=' + this.value + '&' + new URLSearchParams(window.location.search).toString().replace(/&?page=\d+/g, '').replace(/&?per_page=\d+/g, '')">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 / trang</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / trang</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / trang</option>
            </select>
        </div>
    </div>
@endif
