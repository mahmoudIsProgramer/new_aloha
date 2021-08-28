<!--home slider start-->
<section class="megastore-slide collection-banner section-py-space b-g-white">
    <div class="container-fluid">
        <div class="row mega-slide-block">
            <div class="col-xl-9 col-lg-12 ">
                <div class="row">
                    <div class="col-12">
                        <div class="slide-1">
                            @foreach ($mainSliders as $slider)

                                <div>
                                    <div class="slide-main">
                                        <img src="{{ $slider->image_path }}" class="img-fluid bg-img"
                                            alt="mega-store">
                                        <div class="slide-contain">
                                            <div>
                                                {{-- <h4>all product</h4> --}}
                                                <h2>{{ $slider->title }}</h2>
                                                <h3>{{ $slider->description }}</h3>
                                                <a href="{{ $slider->link }}" class="btn btn-rounded btn-md">
                                                    Shop Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    @foreach ($bottomSliders as $bottom)
                        <div class="col-md-6">
                            <div
                                class="collection-banner-main banner-18 banner-style7 collection-color13 p-left text-center">
                                <div class="collection-img">
                                    <img src="{{ $bottom->image_path }}" class="img-fluid bg-img  " alt="">
                                </div>
                                <div class="collection-banner-contain ">
                                    <div>
                                        <h3>{{ $bottom->title }}</h3>
                                        <h4>{{ $bottom->short_description }}</h4>
                                        <a href="{{ $bottom->link }}" class="btn btn-rounded btn-xs"> Shop Now </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-12 ">
                <div class="row collection-p6">

                    @foreach ($rightSliders as $right)
                        <div class="col-xl-12 col-lg-4 col-md-6">
                            <div
                                class="collection-banner-main banner-17 banner-style7 collection-color14 p-left text-center">
                                <div class="collection-img">
                                    <img src="{{ $right->image_path }}" class="img-fluid bg-img  " alt="banner">
                                </div>
                                <div class="collection-banner-contain ">
                                    <div>
                                        <h3>{{ $right->title }}</h3>
                                        <h4>{{ $right->short_description }}</h4>
                                        <a href="{{ $right->image_path }}" class="btn btn-rounded btn-xs"> Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--home slider end-->
