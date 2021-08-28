<?php
    $page="Profile";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])

<div class="page-section inner-page-sec-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">

          @include('customer._account_sidebar')

          <!-- My Account Tab Content Start -->
          <div class="col-lg-9 col-12 mt--30 mt-lg--0">
            <div class="box-content">
              <!-- Single Tab Content Start -->
              <div class="myaccount-content">
                <h3>@lang('site.Favoirtes')</h3>
                <div class="account-details-wishlist">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>@lang('site.image')</th>
                          <th>@lang('site.Product Name')</th>
                          <th>@lang('site.Price')</th>
                          <th>@lang('site.Action')</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach (getCustomer()->favoirtes as $value)
                        <tr>
                          <td><a href="{{ route('productDetails', ['product'=>$value->id]) }}"><img src="{{ $value->image_path }}" alt=""></a></td>
                          <td><a href="{{ route('productDetails', ['product'=>$value->id]) }}">{{ $value->name }}</a></td>
                          <td>{{ $value->total }}</td>
                          <td class="actions">
                            {{-- <a href="{{ route('customer.addToCart', ['product'=>1]) }}" class="btn-addcart"><i
                              class="fas fa-cart-plus"></i> Add To Cart</a> --}}

                            @if(! $value->in_cart )

                            <a href="{{route('customer.addToCart',['product_id'=>$value->id])}}" class="btn-addcart"><i
                                class="fas fa-cart-plus"></i> @lang('site.Add To Cart') </a>

                            @else

                            <a href="{{route('customer.removeFromCart',['product_id'=>$value->id])}}"
                              class="btn-addcart"><i class="fas fa-cart-plus"></i>@lang('site.Remove From Cart') </a>

                            @endif

                            <a href="{{route('customer.toggle_favorite', ['product_id'=> $value->id ])}}"
                              class="btn-remove"><i class="far fa-trash-alt"></i> @lang('site.Remove')</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Single Tab Content End -->
            </div>
          </div>
          <!-- My Account Tab Content End -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
