<!-- side-bar single product slider start -->
<div class="theme-card">
    <h5 class="title-border">RELATED PRODUCTS</h5>
    <div class="related-prods">
        <div>
            <div class="media-banner plrb-0 b-g-white1 border-0">
                @foreach ($relatedProducts as $rel)
                    <div class="media-banner-box">
                        <div class="media">
                            <a href="" class="img-prod-realted">
                                <img src="{{ $rel->image_path }}" class="img-fluid " alt="banner">
                            </a>
                            <div class="media-body">
                                <div class="media-contant">
                                    <div>
                                        <div class="product-detail">
                                            <ul class="rating">
                                                @for ($i = 0; $i < $rel->review; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor

                                                @for ($j = $i; $i < 5; $i++)
                                                    <i class="fa fa-star-0"></i>
                                                @endfor
                                            </ul>
                                            <a href="">
                                                <p>{{ $rel->name }}</p>
                                            </a>
                                            <h6>$47.05 <span>$55.21</span></h6>
                                        </div>
                                        <div class="cart-info">
                                            <button class="tooltip-top add-cartnoty" data-tippy-content="Add to cart">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-shopping-cart">
                                                    <circle cx="9" cy="21" r="1"></circle>
                                                    <circle cx="20" cy="21" r="1"></circle>
                                                    <path
                                                        d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                                    </path>
                                                </svg> </button>
                                            <a href="javascript:void(0)" class="add-to-wish tooltip-top"
                                                data-tippy-content="Add to Wishlist"><i data-feather="heart"
                                                    class="add-to-wish"></i></a>
                                            <a href="{{ route('product', ['product' => $rel->id]) }}"
                                                data-bs-toggle="modal" data-bs-target="#quick-view" class="tooltip-top"
                                                data-tippy-content="Quick View"><i data-feather="eye"></i></a>
                                            <a href="compare.html" class="tooltip-top" data-tippy-content="Compare"><i
                                                    data-feather="refresh-cw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="category.html" class="btn_all">Show All Products</a>
    </div>
</div>
<!-- side-bar single product slider end -->
