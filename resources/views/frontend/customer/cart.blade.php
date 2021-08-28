<?php
    $page="Cart";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])

<!-- Cart Page Start -->
<main class="cart-page-main-block inner-page-sec-padding-bottom">
  <div class="cart_area cart-area-padding  ">
    <div class="container-fluid">
      <div class="page-section-title">
        <h1>@lang('site.Shopping Cart')</h1>
      </div>
      <div class="row no-gutters">
        <div class="col-md-8">
          <!-- Cart Table -->
          <div class="cart-table table-responsive mb--40">
            <table class="table">
              <!-- Head Row -->
              <thead>
                <tr>
                  <th class="pro-thumbnail">@lang('site.Image')</th>
                  <th class="pro-title">@lang('site.Product')</th>
                  <th class="pro-price">@lang('site.Price')</th>
                  <th class="pro-quantity">@lang('site.quantity')</th>
                  <th class="pro-subtotal">@lang('site.total')</th>
                  <th class="pro-remove">@lang('site.Action')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $item)
                <!-- Product Row -->
                <tr>
                  <td class="pro-thumbnail"><a href="{{ route('productDetails', ['product'=>$item->id]) }}"><img
                        src="{{ $item->image_path }}" alt="Product"></a>
                  </td>
                  <td class="pro-title"><a
                      href="{{ route('productDetails', ['product'=>$item->id]) }}">{{ $item->name }}</a></td>
                  <td class="pro-price"><span>{{ $item->totalBlade }}</span></td>
                  <td class="pro-quantity">
                    <div class="pro-qty">
                      <div class="count-input-block">
                        <form action="{{ route('customer.addToCart',['product_id'=>$item->id]) }}" method="post">
                          @csrf
                          @method('post')
                          @include('partials._errors')

                          <input type="hidden" name="product_id" class="form-control input-number"
                            value="{{$item->id}}">

                          <input type="number" name="qty" value="{{ $item->pivot->qty }}"
                            class="form-control text-center" max="{{ $item->stock }}">

                          <input type='submit' class="btn-qty" type="submit" value="{{__('site.edit')}}">

                        </form>

                      </div>
                    </div>
                  </td>
                  <td class="pro-subtotal"><span>{{ $item->totalPriceInCart }}</span></td>
                  <td class="pro-remove"><a href="{{ route('removeFromCart', ['product'=>$item->id]) }}"><i
                        class="far fa-trash-alt"></i></a></td>
                </tr>
                <!-- // Product Row -->
                @endforeach
                <!-- Coupon -->
                <tr>
                  <td colspan="6" class="actions">

                    <form method="post" action="{{ route('customer.getPromocodeDiscount') }}">

                      @include('partials._errorsPromocode')
                      @csrf
                      @method('post')
                      <div class="coupon-block">
                        <div class="coupon-text">
                          <label for="coupon_code">@lang('site.promocode'):</label>
                          <input type="text" name="code" required class="input-text" id="coupon_code" value=""
                            placeholder="@lang('site.Coupon code')">
                        </div>
                        <div class="coupon-btn">
                          <input type="submit" class="btn btn-outlined" name="apply_coupon" value="@lang('site.Apply coupon')">
                        </div>
                      </div>
                    </form>

                    @if (session()->has('coupon'))
                    @php $promocodeDiscount=getProDiscountValue(); @endphp
                    <a href="{{route('customer.removePromocode')}}" style="color: red"> {{ __('site.Remove') }} </a>
                    @lang('site.Discount') ({{ getProDiscountName() }})
                    :{{ getProDiscountValue() }} @lang('site.'.config('site_options.currency'))
                    @endif

                  </td>
                </tr>
                <!-- // Coupon -->

              </tbody>
            </table>
          </div>
        </div>
        <!-- Cart Summary -->
        <div class="col-md-4 d-flex">
          <div class="cart-summary">
            <div class="cart-summary-wrap">
              <h4><span>@lang('site.Order Summary')</span></h4>
              <p>@lang('site.subtotal') <span class="text-primary">{{ getCustomer()->totalCart }}
                  @lang('site.'.config('site_options.currency'))</span></p>
              {{-- <p>Shipping Cost <span class="text-primary">$00.00</span></p> --}}
              <h2>@lang('site.Grand Total') <span class="text-primary">
                  {{ getCustomer()->totalCart - getProDiscountValue() }}
                  @lang('site.'.config('site_options.currency')) </span>
              </h2>
            </div>
            <div class="cart-summary-button">
              <a href="{{ route('customer.checkout') }}" class="checkout-btn c-btn btn--primary">@lang('site.Checkout')</a>
              {{-- <button class="update-btn c-btn btn-outlined">Update Cart</button> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
<!-- Cart Page End -->

@endsection
