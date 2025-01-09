@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-sm text-gray-500 bg-gray-200 rounded-md cursor-default">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-2 text-sm text-blue-600 bg-white border rounded-md hover:bg-blue-100">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-gray-500 bg-gray-200 rounded-md">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 text-sm text-white bg-blue-600 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-2 text-sm text-blue-600 bg-white border rounded-md hover:bg-blue-100">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-2 text-sm text-blue-600 bg-white border rounded-md hover:bg-blue-100">Next</a>
        @else
            <span class="px-3 py-2 text-sm text-gray-500 bg-gray-200 rounded-md cursor-default">Next</span>
        @endif
    </nav>
@endif
