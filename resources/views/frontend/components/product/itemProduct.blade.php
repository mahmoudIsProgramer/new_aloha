<div>
    <div class="product-box product-box2">
        <div class="product-imgbox">
            <div class="img-prod">
                <a href="{{ route('product', ['product' => $product->id]) }}">
                    <img src="{{ $product->image_path }}" class="img-fluid  " alt="product">
                </a>
            </div>
            <div class="product-icon icon-inline">
                <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                    <i data-feather="shopping-cart"></i>
                </button>
                <a href="javascript:void(0)" class="add-to-wish tooltip-top" data-tippy-content="Add to Wishlist">
                    <i data-feather="heart"></i>
                </a>
                <a href="{{ route('product', ['product' => $product->id]) }}" class="tooltip-top"
                    data-tippy-content="View Details">
                    <i data-feather="eye"></i>
                </a>
                <a href="" class="tooltip-top" data-tippy-content="Compare">
                    <i data-feather="refresh-cw"></i>
                </a>
            </div>
            <div class="new-label1">
                <div>new</div>
            </div>
            <div class="on-sale1">
                on sale
            </div>
        </div>
        <div class="product-detail product-detail2 ">
            <ul>
                @for ($i = 0; $i < $product->review; $i++)
                    <li><i class="fa fa-star"></i></li>
                @endfor
                @for ($j = $i; $j < 5; $j++)
                    <li><i class="fa fa-star-o"></i></li>
                @endfor
            </ul>
            <a href="{{ route('product', ['product' => $product->id]) }}">
                <h3>{{ $product->name }}</h3>
            </a>
            <h5>
                $50
                <span>
                    $80
                </span>
            </h5>
        </div>
    </div>
</div>
