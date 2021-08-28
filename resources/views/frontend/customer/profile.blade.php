<?php
$page = 'Profile';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!--section start-->
    <!-- START => Profile -->
    <section class="page-profile py-5">
        <div class="container">

            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-profile">
                        <strong class="h3 title__profile d-block mb-4"> <span>User Profile</span> <span
                                class="btn-toggle-menu"><i class="fa fa-bars"></i></span></strong>

                        @include('frontend.customer._account_sidebar')

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-profile profile-details">
                        <div class="title-box-profile">
                            <strong class="h3 d-block">Information</strong>
                        </div>
                        <hr style="background-color: #fff;">

                        <form action="{{ route('customer.update_profile', ['customer' => $customer->id]) }}" method="post"
                            class="pt-4">
                            @csrf
                            {{ method_field('PUT') }}
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="">@lang('site.full_name')</label>
                                    <input type="text" name="full_name"
                                        value="{{ old('full_name', $customer->full_name) }}" class="form-control"
                                        placeholder="@lang('site.full_name')" id="">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">@lang('site.email')</label>
                                    <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                        class="form-control" placeholder="@lang('site.email')" id="">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">@lang('site.phone')</label>
                                    <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                                        class="form-control" placeholder="@lang('site.phone')" id="">
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="">@lang('site.address')</label>
                                    <input type="text" name="address" value="{{ old('address', $customer->address) }}"
                                        class="form-control" placeholder="@lang('site.address')" id="">
                                </div>
                                <div class="col-md-12 mb-4 text-end">
                                    <input type="submit" class="btn btn-primary btn-chkout" value="Save Change">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- //END => Profile -->
    <!--section end-->

    <!-- //END => Content Pages -->
@endsection
