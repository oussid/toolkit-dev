
<div class="custom-pagination">
    @if ($paginator->hasPages())
        <div class="custom-pagination-count">
            Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{$paginator->total()}} entries
        </div>
        <div class="custom-pagination-links">
            {{-- next page --}}
            @if ($paginator->onFirstPage())
                <button class="disabled">
                    Prev
                </button>
            @else 
                <a href="{{ $paginator->previousPageUrl()}}">
                    <button >
                        Prev
                    </button>
                </a>
            @endif
        
                @foreach ($elements as $element)
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <!--  Use three dots when current page is greater than 4.  -->
                            @if ($paginator->currentPage() > 4 && $page === 2)
                                <button class="disabled">...</button>
                            @endif

                            <!--  Show active page else show the first and last two pages from current page.  -->
                            @if ($page == $paginator->currentPage())
                                <button class="active" >{{$page}}</button>
                            @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                                <a href="{{ $url }}"><button>{{$page}}</button></a> 
                            @endif

                            <!--  Use three dots when current page is away from end.  -->
                            @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                                <button class="disabled">...</button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
            {{-- next page --}}
            @if (!$paginator->hasMorePages())
                <button class="disabled">
                    Next
                </button>
            @else 
                <a href="{{ $paginator->nextPageUrl()}}">
                    <button >
                        Next
                    </button>
                </a>
            @endif
    
        </div>
    @endif
    </div>
        

    <!-- Pagination Elements -->

    