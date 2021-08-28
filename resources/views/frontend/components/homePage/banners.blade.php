@if (isset($home_page_1_banner) && $home_page_1_banner->is_active)
    <!--discount banner start-->
    <section class="discount-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="discount-banner-contain">
                        <h2>{{ $home_page_1_banner->title }}</h2>
                        {!! $home_page_1_banner->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--discount banner end-->
@endif

@if (isset($home_page_2_banner) && $home_page_2_banner->is_active)
    <!--sale banner start-->
    <section class="sale-banenr banner-style2  section-big-mt-space">
        <img src="{{ $home_page_2_banner->image_path }}" alt="sale-banenr" class="img-fluid bg-img">
        <div class="custom-container">
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="sale-banenr-contain text-center  p-right">
                        <div>
                            <h4>{{ $home_page_2_banner->title }}</h4>
                            {!! $home_page_2_banner->description !!}
                            <a href="{{ $home_page_2_banner->link }}" class="btn btn-rounded">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--sale banner ned-->
@endif
@if (isset($home_page_3_banner) && $home_page_3_banner->is_active)

    <!--deal banner start-->
    <section class="deal-banner ">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="deal-banner-containe">
                        <h2>
                            {{ $home_page_3_banner->title }}
                        </h2>
                        {!! $home_page_3_banner->description !!}
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 ">
                    <div class="deal-banner-containe">
                        <diV class="deal-btn">
                            <a href="{{ $home_page_3_banner->link }}" class="btn-white">
                                View more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--deal banner end-->
@endif
