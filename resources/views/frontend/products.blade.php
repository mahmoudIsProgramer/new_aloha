<?php
$page = 'Products';
?>

@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')
@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!-- section start -->
    <section class="section-big-pt-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row">

                    @include('frontend.components.filter')

                    <div class="collection-content col">
                        <div class="page-main-content">

                            <div class="collection-product-wrapper">
                                <div class="product-top-filter">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="filter-main-btn"><span class="filter-btn  "><i class="fa fa-filter"
                                                        aria-hidden="true"></i> Filter</span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="product-filter-content">
                                                <div class="collection-view">
                                                    {{-- <h5>1-{{  count($products->items()) }} of {{ $products->count() }} Result</h5> --}}
                                                </div>

                                                <div class="product-page-filter">
                                                    <select>
                                                        <option value="High to low">items per page</option>
                                                        <option value="Low to High">50 Products</option>
                                                        <option value="Low to High">100 Products</option>
                                                    </select>
                                                    {{-- @foreach ([12, 50, 100] as $value)
                                                        <a href="{{ route('products', ['perPage' => $value] + request()->query()) }}"
                                                            class="dropdown-item">
                                                            {{ $value }}
                                                        </a>
                                                    @endforeach --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-wrapper-grid product">
                                    <div class="row">
                                        @foreach ($products as $key => $product)
                                            <div class="col-md-4 col-6">
                                                @include('frontend.components.product.itemProduct',['product'=>$product])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Pagination -->
                                {{ $products->appends(request()->query())->links('frontend.pagination.custom') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- section End -->
@endsection
