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

    <!--section start-->
    <section class="wishlist-section section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">availability</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSellers as $productSeller)
                                @php  $route =  route('product', ['product' => $product->id, 'seller_id' => $productSeller->seller_id])  @endphp
                                <tr>
                                    <td>
                                        <a href="{{ $route }}"><img src="{{ $productSeller->product->image_path }}"
                                                alt="product" class="img-fluid"></a>
                                    </td>
                                    <td><a href="{{ $route }}">{{ $productSeller->product->name }}</a>
                                    </td>
                                    <td>
                                        <h2>{{ $productSeller->total }}</h2>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $productSeller->seller->full_name }}
                                            <br> SKU: {{ $productSeller->sku }}
                                            <br> Item ID: #{{ $productSeller->id }}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{ $route }}"
                                            class="cart"><i class="ti-shopping-cart"></i>
                                            See
                                            Products </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
