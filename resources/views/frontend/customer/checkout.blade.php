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
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Contact Details</h3>
                                </div>
                                <div class="theme-form">
                                    <h3 class="pb-3">My Addresses</h3>
                                    <hr>
                                    <div class="my_addresses">
                                        <label for="chk-address-1">
                                            <div class="card" style="width: 100%">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="chkaddress"
                                                        id="chk-address-1">
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Home Address</h5>
                                                    <p class="card-text">
                                                        145 14, cairo, giza St., 15 Mayu, 15 Mayu, Cairo
                                                    </p>
                                                </div>
                                                <a href="#" class="btn_edit_address"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn_del_address"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </label>
                                        <label for="chk-address-2">
                                            <div class="card" style="width: 100%">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="chk-address-2"
                                                        name="chkaddress" />
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Business Address</h5>
                                                    <p class="card-text">
                                                        145 14, cairo, giza St., 15 Mayu, 15 Mayu, Cairo
                                                    </p>
                                                </div>
                                                <a href="#" class="btn_edit_address"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn_del_address"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details theme-form  section-big-mt-space">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">
                                            <li>Pink Slim Shirt × 1 <span>$25.10</span></li>
                                            <li>SLim Fit Jeans × 1 <span>$555.00</span></li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li>Subtotal <span class="count">$380.10</span></li>
                                        </ul>
                                        <ul class="total">
                                            <li>Total <span class="count">$620.00</span></li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" id="payment-1"
                                                                checked="checked">
                                                            <label for="payment-1">Check Payments<span
                                                                    class="small-text">Please send a check to Store
                                                                    Name, Store Street, Store Town, Store State / County,
                                                                    Store Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" id="payment-2">
                                                            <label for="payment-2">Cash On Delivery<span
                                                                    class="small-text">Please send a check to
                                                                    Store Name, Store Street, Store Town, Store State /
                                                                    County, Store
                                                                    Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input type="radio" name="payment-group" id="payment-3">
                                                            <label for="payment-3">PayPal</label>
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
