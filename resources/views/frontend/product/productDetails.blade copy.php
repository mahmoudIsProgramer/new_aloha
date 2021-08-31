<?php
$page = 'productDetails';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('image_url_share') {{ $product->image_path ?? '' }}@endsection
    @section('description_share'){{ $product->description }} @endsection
@section('title_share'){{ $product->title }}@endsection

@section('content')
    @include('partials.breadCrumb',['page'=>$page,'custome_title'=>$product->name])

    <!-- section start -->
    <section class="section-big-pt-space b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-slick no-arrow">
                                    @foreach ($product->productImages as $img)
                                        <div><a href="javascript:void(0)" data-fancybox="gallery"><img
                                                    src="{{ $img->image_path }}" alt="" class="img-fluid"></a></div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12 p-0">
                                        <div class="slider-nav">
                                            @foreach ($product->productImages as $img)
                                                <div><img src="{{ $img->image_path }}" alt="" class="img-fluid"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 rtl-text">
                                <div class="product-right">
                                    <div class="pro-group">
                                        <h2>{{ $product->title }}</h2>
                                        <ul class="pro-price">
                                            <li>{{ $product->getTotal(request()->seller_id) }}</li>
                                            {{-- <li><span>mrp $140</span></li> --}}
                                            @if ($per = $product->discountPercent(request()->seller_id) > 0)
                                                <li>{{ $per }} % off</li>
                                            @endif
                                        </ul>
                                        <div class="revieu-box">
                                            <ul>
                                                @for ($i = 0; $i < $product->review; $i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                                @for ($j = $i; $j < 5; $j++)
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endfor
                                            </ul>
                                            <a href="javascript:void(0)"><span>({{ $product->total_number_review }}
                                                    reviews)</span></a>
                                        </div>
                                    </div>

                                    <form action="{{ route('customer.addToCart', ['product' => $product->id]) }}">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="product_seller_id" value="{{ $productSeller->id }}">
                                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="seller_id" value="{{ $seller->id }}"> --}}
                                        <div id="selectSize"
                                            class="pro-group addeffect-section product-description border-product mb-0">

                                            <h6 class="product-title">Features</h6>
                                            <div class="features-box mb-4">
                                                @include('frontend.product.variations')

                                            </div>
                                            <div class="features-box mb-4">
                                                seller : {{ $seller->full_name }}
                                            </div>

                                            <h6 class="product-title">quantity</h6>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <button type="button" class="qty-minus"></button>
                                                    <input name="qty" type="number" min='1' max='{{ $productSeller->stock }}'
                                                        class="qty-adj form-control"
                                                        value="{{ old('qty', $product->qtyInCart($seller->id)) }}">
                                                    <button type="button" class="qty-plus"></button>
                                                </div>
                                            </div>

                                            <div class="product-buttons">
                                                <button id="cartEffect" class="btn cart-btn btn-normal tooltip-top"
                                                    data-tippy-content="Add to cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    add to cart
                                                </button>
                                                <button class="btn btn-normal add-to-wish tooltip-top"
                                                    data-tippy-content="Add to wishlist">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="pro-group">
                                        <div class="product-offer">
                                            <h6 class="product-title"><i class="fa fa-tags"></i>5 offers Available </h6>
                                            <div class="offer-contain">
                                                <ul>
                                                    <li>
                                                        <span class="code-lable">OFFER40</span>
                                                        <div>
                                                            <h5>Get extra $40 off on first Orders</h5>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-group">
                                        <h6 class="product-title">product infomation</h6>
                                        <p>{{ $product->short_description }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @include('frontend.product.relatedProducts')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->

    <!-- product-tab starts -->
    <section class=" tab-product  tab-exes ">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12 col-lg-12 ">
                    <div class=" creative-card creative-inner">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                    href="#top-home" role="tab" aria-selected="true">Description</a>
                                <div class="material-border"></div>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                                    href="#top-profile" role="tab" aria-selected="false">Specification </a>
                                <div class="material-border"></div>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab"
                                    href="#top-review" role="tab" aria-selected="false">Reviews</a>
                                <div class="material-border"></div>
                            </li>
                        </ul>
                        <div class="tab-content nav-material" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                aria-labelledby="top-home-tab">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                <div class="single-product-tables">
                                    <table>
                                        <tbody>
                                            @foreach ($product->details as $det)
                                                <tr>
                                                    <th>{{ $det->specification->name }}</th>
                                                    <td>{{ $det->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- reviews --}}
                            @include('frontend.product.reviews')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-tab ends -->

@endsection
