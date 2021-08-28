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

              <!-- this row will not appear when printing -->

              {{-- @if( has_permission(getCustomer(),'immediate_account_statement'))
              <div class="row no-print">
                <div class="col-xs-12">
                  <button onclick="window.print();" class="btn btn-primary"><i
                      class="fa fa-print"></i>@lang('site.print')</button>
                </div>
              </div>
              @endif --}}

              <!-- Single Tab Content Start -->
              <div class="myaccount-content">
                <h3>@lang('site.orders')</h3>
                <div class="account-details-order">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          {{-- <th>Name</th> --}}
                          <th>@lang('site.created_at')</th>
                          <th>@lang('site.status')</th>
                          <th>@lang('site.Total')</th>
                          <th>@lang('site.Action')</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $customer->orders()->latest()->get() as $value )
                        <tr>
                          <td>{{ $value->id }}</td>
                          {{-- <td>Order Name</td> --}}
                          <td>{{ $value->created_at }}</td>
                          <td>{{ $value->status }}</td>
                          <td>{{ $value->total }}</td>
                          <td><a href="{{ route('customer.orderDetails', ['order'=>$value->id]) }}">@lang('site.Show')</a></td>
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
