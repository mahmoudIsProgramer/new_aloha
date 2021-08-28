<div>
    <div class="hotdeal-box">
        <div class="img-wrapper">
            <a href="product-details.html">
                <img src="{{ $product->image_path }}" alt="hot-deal" class="img-fluid bg-img">
            </a>
        </div>
        <div class="hotdeal-contain">
            <div>
                <a href="product-details.html">
                    <h3>{{ $product->name }}</h3>
                </a>
                <h5>
                    $60
                    <span class="price">$80</span>
                </h5>
                <p>{{ Str::limit($product->name, 100, $end = '....') }} </p>
                <ul>
                    <li>
                        <i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i>
                    </li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
                <div class="timer2">
                    <p id="demo">
                    </p>
                </div>
                <a href="javascript:void(0)" class="btn btn-solid btn-sm add-cartnoty">add to
                    cart</a>
            </div>
        </div>
    </div>
</div>
