<?php
$page = 'Checkout';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!-- section start -->
    <section class="section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="checkout-page">
                <div class="checkout-form">
                    <form action="{{ route('customer.checkoutPost') }}" method="POST">
                        @csrf
                        @method('post')
                        @include('partials._errors')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Contact Details</h3>
                                </div>
                                <div class="theme-form">
                                    <h3 class="pb-3">My Addresses</h3>
                                    <hr>
                                    <div class="my_addresses">

                                        @forelse ($addresses as $address)

                                            <label for="chk-address-1">
                                                <div class="card" style="width: 100%">
                                                    <div class="form-check">
                                                        <input name="address_id" required
                                                            value="{{ old('address_id', $address->id) }}"
                                                            class="form-check-input" type="radio" name="chkaddress"
                                                            id="chk-address-1">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $address->type }}</h5>
                                                        <p class="card-text">
                                                            145 14, cairo, giza St., 15 Mayu, 15 Mayu, Cairo
                                                        </p>
                                                    </div>
                                                    <a href="#" class="btn_edit_address"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn_del_address"><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </label>
                                        @empty
                                            @include('partials.no_data_found')
                                        @endforelse
                                        <a href="{{ route('customer.addresses.create') }}">add new address </a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details theme-form  section-big-mt-space">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        @foreach ($customer->productSellers as $productSeller)
                                            <ul class="qty">
                                                <li>{{ $productSeller->product->name }} x
                                                    {{ $productSeller->qtyInCart }}<span>
                                                        {{ $productSeller->ProductTotalInCart }}</span></li>
                                            </ul>
                                        @endforeach
                                        <ul class="sub-total">
                                            <li>taxes <span class="count">{{ $taxes }}</span>
                                            </li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li>Subtotal <span class="count">{{ $customer->totalCart }}</span>
                                            </li>
                                        </ul>
                                        <ul class="total">
                                            <li>Total <span
                                                    class="count">{{ $customer->totalCart + $taxes }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment_method" value="cashOnDelivery"
                                                                id="payment-2" required>
                                                            <label for="payment-2">Cash On Delivery<span
                                                                    class="small-text">Please send a check to
                                                                    Store Name, Store Street, Store Town, Store State /
                                                                    County, Store
                                                                    Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn-normal btn">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <!-- //END => Content Pages -->
@endsection

@push('scripts')
@endpush
