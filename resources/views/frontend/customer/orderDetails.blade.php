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
                <h3>@lang('site.order details')</h3>
                <div class="account-details-order">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>@lang('site.product name')</th>
                          <th>@lang('site.qty')</th>
                          <th>@lang('site.Price')</th>
                          <th>@lang('site.Discount')</th>
                          <th>@lang('site.Total')</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $order->products as $value )
                        <tr>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->pivot->qty }}</td>
                          <td>{{ $value->sale_price }}</td>
                          <td>{{ $value->discount }}</td>
                          <td>{{ $value->total }} </td>
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
