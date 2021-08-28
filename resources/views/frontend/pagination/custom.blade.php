@if ($paginator->hasPages())
    <div class="product-pagination">
        <div class="theme-paggination-block">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">

                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span
                                            aria-hidden="true"><i class="fa fa-chevron-left"
                                                aria-hidden="true"></i></span>
                                        <span class="sr-only">Previous</span></a></li>
                            @else
                                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link"
                                        aria-label="Previous"><span aria-hidden="true"><i class="fa fa-chevron-left"
                                                aria-hidden="true"></i></span>
                                        <span class="sr-only">Previous</span></a></li>
                            @endif


                            {{-- Pagination Elements --}}
                            @foreach ($elements as $element)

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)

                                        @if ($page == $paginator->currentPage())
                                            <li class="page-item active"><a class="page-link"
                                                    href="">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif

                                    @endforeach
                                @endif

                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                                        aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i></span>
                                        <span class="sr-only">Next</span></a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                            aria-hidden="true"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i></span>
                                        <span class="sr-only">Next</span></a></li>
                            @endif

                        </ul>

                    </nav>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="product-search-count-bottom">
                        <h5>@lang('site.showing_products') 1-{{ count($paginator) }} @lang('site.of') {{ $paginator->total()  }}
                            @lang('site.result')</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
