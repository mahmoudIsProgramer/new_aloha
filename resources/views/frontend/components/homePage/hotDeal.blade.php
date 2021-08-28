<!--title-start-->
<div class="title8 section-big-pt-space">
    <h4>deal of the day</h4>
</div>
<!--title-end-->

<!-- hot deal start -->
<section class="hotdeal-second section-big-mb-space">
    <div class="container-fluid">
        <div class="row hotdeal-block2">
            <div class="col-12">
                <div class="hotdeal-slide3 no-arrow">
                    @foreach ($products as $key => $product)
                        @include('frontend.components.product.hotdealItemProduct',['product'=>$product])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hot deal start -->
