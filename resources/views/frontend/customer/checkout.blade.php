<?php
$page = 'Checkout';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])


    <!-- Checkout Page Start -->
    <main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Form s-->
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">
                                <h1 class="quick-title mb-5">@lang('site.Checkout')</h1>
                                <!-- Slide Down Trigger  -->
                                <div class="checkout-quick-box">
                                    <p><i class="far fa-sticky-note"></i>@lang('site.Do you have a discount code?') <a
                                            href="javascript:" class="slide-trigger" data-target="#quick-cupon">
                                            @lang('site.Click here to enter your code')</a></p>
                                </div>
                                <!-- Slide Down Blox ==> Cupon Box -->
                                <div class="checkout-slidedown-box" id="quick-cupon">
                                    <form method="post" action="{{ route('customer.getPromocodeDiscount') }}">

                                        @include('partials._errorsPromocode')
                                        @csrf
                                        @method('post')
                                        <div class="checkout_coupon">
                                            <input type="text" name="code" required class="mb-0" placeholder="Coupon Code">
                                            {{-- <a href="" class="btn btn-outlined">Apply coupon</a> --}}

                                            @if (session()->has('coupon'))
                                                @php $promocodeDiscount=getProDiscountValue(); @endphp
                                                <a href="{{ route('customer.removePromocode') }}" style="color: red">
                                                    {{ __('site.Remove') }} </a>
                                                @lang('site.Discount') ({{ getProDiscountName() }})
                                                :{{ getProDiscountValue() }}
                                                @lang('site.'.config('site_options.currency'))
                                            @endif
                                            <div class="coupon-btn">
                                                <input type="submit" class="btn btn-outlined" name="apply_coupon"
                                                    value="Apply coupon">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- Start : Form -->
                                <form action="{{ route('customer.checkoutPost') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    @include('partials._errors')
                                    <input type="hidden" name="code" value="{{ getProDiscountName() }}">
                                    <div class="row">
                                        <div class="col-lg-7 mb--20">
                                            <!-- Billing Address -->
                                            <div id="billing-form" class="mb-40">
                                                {{-- <h4 class="checkout-title">@lang('sitte.Billing Address')</h4> --}}
                                                <div class="row">
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.name')*</label>
                                                        <input name="customer_name" required type="text" value="{{ $customer->full_name }}"
                                                            placeholder="@lang('site.name')">
                                                    </div>
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.company_name') </label>
                                                        <input name="company_name" type="text" value="{{ $customer->company_name }}"
                                                            placeholder="@lang('site.company_name')">
                                                    </div>
                                                    <div class="-12 col-12 mb--20">
                                                        <label>@lang('site.delivery') *</label>
                                                        <select name='city_id' class="nice-select" required>
                                                            <option value=""> {{ __('site.city') }} </option>
                                                            @foreach ($deliveries as $dev)
                                                                <option value="{{ $dev->city_id }}" @if (old('city_id') == $dev->city_id) 'selected' @endif>
                                                                    {{ $dev->city->name }} - [{{ $dev->price }} ]
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-12 mb--20">
                                                        <label>{{ __('site.Payment Method') }} *</label>
                                                        <select name='payment_method' required class="nice-select" required>
                                                            <option value=""> {{ __('site.Payment Method') }} </option>
                                                            @foreach (paymentMethods() as $value)
                                                                @if (skipPaymentMethods($value))
                                                                    @continue
                                                                @endif
                                                                <option value="{{ $value }}" @if (old('payment_method') == $value) 'selected' @endif>
                                                                    {{ __('site.' . $value) }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.Email Address')*</label>
                                                        <input name="customer_email" type="email" value="{{ $customer->email }}"
                                                            placeholder="@lang('site.Email Address')">
                                                    </div>
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.Phone')*</label>
                                                        <input name="customer_phone" type="text" value="{{ $customer->phone }}"
                                                            placeholder="@lang('site.Phone')">
                                                    </div>
                                                    <div class="col-12 mb--20">
                                                        <label>@lang('site.address')*</label>
                                                        <input name="customer_address" type="text" value="{{ $customer->address }}"
                                                            placeholder="@lang('site.address')">
                                                        {{-- <input type="text" placeholder="Address line 2"> --}}
                                                    </div>
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.city')*</label>
                                                        <input name="customer_city" type="text"
                                                            placeholder="@lang('site.city')">
                                                    </div>
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.State')*</label>
                                                        <input name='customer_region' type="text"
                                                            placeholder="@lang('site.State')">
                                                    </div>
                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>@lang('site.Zip Code')*</label>
                                                        <input name="customer_postal_code" type="text"
                                                            placeholder="@lang('site.Zip Code')">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="order-note-block mt--30">
                                                <label for="order-note">@lang('site.Order notes')</label>
                                                <textarea name="order_notes" id="order-note" cols="30" rows="10"
                                                    class="order-note"
                                                    placeholder="@lang('site.Notes about your order, e.g. special notes for delivery.')"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <!-- Cart Total -->
                                                <div class="col-12">
                                                    <div class="checkout-cart-total">
                                                        <h2 class="checkout-title">@lang('site.Order Details')</h2>
                                                        <h4>@lang('site.Product') <span>@lang('site.total')</span></h4>

                                                        <ul>
                                                            @foreach ($customer->products as $item)
                                                                <li><span class="left">{{ $item->name }} (
                                                                        {{ $item->total }} X {{ $item->pivot->qty }})
                                                                    </span> <span class="right">{{ $item->totalCart }}
                                                                        @lang('site.'.config('site_options.currency'))
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                        <p>@lang('site.subtotal') <span> {{ $customer->totalCart }}
                                                                @lang('site.'.config('site_options.currency'))</span></p>
                                                        @if (getProDiscountName())

                                                            <p>@lang('site.promocode') <span>
                                                                    {{ getProDiscountValue() }}
                                                                    @lang('site.'.config('site_options.currency'))</span>
                                                            </p>
                                                        @endif
                                                        {{-- <p>Shipping Fee <span>$00.00</span></p> --}}
                                                        <h4>@lang('site.Grand Total') <span>
                                                                {{ $customer->totalCart - getProDiscountValue() }}
                                                                @lang('site.'.config('site_options.currency'))</span></h4>
                                                        <div class="term-block">
                                                            <input type="checkbox" id="accept_terms2">
                                                            <label for="accept_terms2">@lang("site.I’ve read and accept the terms & conditions")</label>
                                                        </div>
                                                        <button type="submit"
                                                            class="place-order w-100">@lang('site.submit')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> <!-- End : Form -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- // Checkout Page End -->

@endsection

@push('scripts')
@endpush
