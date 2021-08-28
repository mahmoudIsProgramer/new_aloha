@if ($brands->count() > 0)
    <!--title-start-->
    <div class="title8 section-big-pt-space ">
        <h4>featured brands</h4>
    </div>
    <!--title-end-->

    <!-- brand start -->
    <section class="brand-second section-big-mb-space">
        <div class="container-fluid">
            <div class="row brand-block">
                <div class="col-12">
                    <div class="brand-slide12 no-arrow mb--5">
                      @foreach ( $brands as $brand )
                      <div>
                        <div class="brand-box">
                          <img src="{{ $brand->image_path }}" alt="brand" class="img-fluid">
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- brand start -->
@endif
