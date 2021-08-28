<?php
    $page="add_complaint";
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
                <h3>@lang('site.add_complaint')</h3>
                <div class="account-details-form">
                  <form method="post" action="{{ route('customer.add_complaint_post') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="customer_id" value="{{getCustomer()->id }}">
                    <div class="row">
                      <div class="col-md-12 col-12  mb--30">
                        <label for="">@lang('site.Upload File')</label>
                        <input type="file" name="image" class="form-control">
                      </div>
                      {{-- <div class="col-md-6 col-12  mb--30">
                        <input id="first-name" placeholder="Full Name" type="text">
                      </div>
                      <div class="col-md-6 col-12  mb--30">
                        <input id="first-name" placeholder="Phone" type="text">
                      </div> --}}
                      <div class="col-md-12 mb--30">
                        <textarea name="complaint" required placeholder="@lang('site.add_complaint')"
                          class="form-control"></textarea>
                      </div>
                      <div class="col-12">
                        <button class="btn btn--primary">@lang('site.submit')</button>
                      </div>
                    </div>
                  </form>
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
