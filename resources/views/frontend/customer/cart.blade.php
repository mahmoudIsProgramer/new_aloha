<?php
$page = 'Cart';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!--section start-->
    <section class="cart-section section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">seller</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">total</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        @foreach ($productSellers as $productSeller)
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)"><img src="{{ $productSeller->product->image_path }}"
                                                alt="cart" class=" "></a>
                                    </td>
                                    <td><a
                                            href="{{ route('product', ['product' => $productSeller->product->id, 'seller_id' => $productSeller->seller->id]) }}">{{ $productSeller->product->name }}</a>
                                    </td>
                                    <td>
                                        <h2>{{ $productSeller->seller->full_name }}</h2>
                                    </td>
                                    <td>
                                        <h2>{{ $productSeller->total }}</h2>
                                    </td>
                                    <td>
                                        <form action="{{ route('customer.addToCart') }}" method="post">
                                            @csrf
                                            @method('post')
                                            @include('partials._errors')
                                            <input type="hidden" name="product_seller_id"
                                                value="{{ $productSeller->id }}">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="qty" class="form-control input-number"
                                                        value="{{ $productSeller->qty_in_cart }}" max="">
                                                </div>
                                                <input type='submit' class="btn btn-danger" type="submit"
                                                    value="{{ __('site.edit') }}">


                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <h2 class="td-color">{{ $productSeller->product_total_in_cart }}</h2>
                                    </td>
                                    <td><a href="{{ route('customer.removeFromCart', ['product_seller_id' => $productSeller->id]) }}"
                                            class="icon"><i class="ti-close"></i></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                            <tr>
                                <td>total price :</td>
                                <td>
                                    <h2>{{ getCustomer()->totalCart }}</h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-12">
                    <a href="{{ route('products') }}" class="btn btn-normal">continue shopping</a>
                    <a href="{{ route('customer.checkout') }}" class="btn btn-normal ms-3">check out</a>
                </div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
