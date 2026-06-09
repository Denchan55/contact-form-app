@if ($paginator->hasPages())
    <nav class="flex justify-start items-center space-x-4 mt-6">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-400 border border-[#ddd8d3] rounded cursor-not-allowed">
                &laquo; Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-4 py-2 text-[#6b5f57] border border-[#ddd8d3] rounded hover:bg-[#f7f2ed]">
                &laquo; Previous
            </a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-4 py-2 text-[#6b5f57] border border-[#ddd8d3] rounded hover:bg-[#f7f2ed]">
                Next &raquo;
            </a>
        @else
            <span class="px-4 py-2 text-gray-400 border border-[#ddd8d3] rounded cursor-not-allowed">
                Next &raquo;
            </span>
        @endif

    </nav>
@endif