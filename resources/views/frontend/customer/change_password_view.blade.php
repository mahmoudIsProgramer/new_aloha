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
                            <strong class="h3 d-block">My Orders</strong>
                        </div>
                        <hr style="background-color: #fff;">

                        <form action="{{ route('customer.change_password') }}" method="post">
                            @method('post')
                            @csrf
                            @include('partials._errors')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="">Old Password</label>
                                        <input name="old_password" required type="password" class="form-control"
                                            placeholder="Old Password" name="" id="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="">New Password</label>
                                        <input name="password" required type="password" class="form-control"
                                            placeholder="New Password" name="" id="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="">Confirm Password</label>
                                        <input name="password_confirmation" required type="password" class="form-control"
                                            placeholder="Confirm Password" name="" id="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4"><input type="submit" class="btn btn-primary border-0"
                                            value="Change Password"></div>
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
@endsection
