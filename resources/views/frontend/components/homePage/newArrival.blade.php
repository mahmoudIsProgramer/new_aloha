<!--title start-->
<div class="title8 section-big-pt-space">
    <h4>new Arrivals</h4>
</div>
<!--title end-->

<!-- product tab start -->
<section class="section-big-mb-space ratio_square product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pr-0">
                <div class="product-slide-5 product-m no-arrow">
                    @foreach ($products as $key => $product)
                        <div>
                            @include('frontend.components.product.itemProduct',['product'=>$product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->
