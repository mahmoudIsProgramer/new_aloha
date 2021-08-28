<?php
$page = 'Register';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!--section start-->
    <section class="login-page section-big-py-space b-g-light bg_section"
        style="background-image: url(assets/imgs/bg-register.jpg)">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-5 offset-lg-4">
                    <div class="theme-card">
                        <h3 class="text-center">Create account</h3>
                        <form action="{{ route('customer.register.post') }}" method="post" class="theme-form" >
                            @csrf
                            @method('post')
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="email">Full Name</label>
                                    <input name="full_name" required value="{{ old('full_name') }}" type="text"
                                        class="form-control" id="fname" placeholder="Full Name">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="review">Phone</label>
                                    <input name="phone" required value="{{ old('phone') }}" type="text"
                                        class="form-control" id="lname" placeholder="Phone">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>email</label>
                                    <input name="email" required value="{{ old('email') }}" type="text"
                                        class="form-control" placeholder="Email">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password</label>
                                    <input name="password" required value="{{ old('password') }}" type="password"
                                        class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" required
                                        value="{{ old('password_confirmation') }}" type="password" class="form-control"
                                        placeholder="Confirm password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div
                                        class="custom-control new_style custom-checkbox form-check collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input form-check-input p-0"
                                            id="chk-privacy">
                                        <label class="custom-control-label form-check-label" for="chk-privacy">
                                            I agree <a href="{{ route('staticPages', ['page' => 'terms']) }}">Terms and
                                                conditions</a> & <a href="">Privacy policy</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-normal">create Account</button>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        Have you already account? <a href="{{ route('customer.login') }}"
                                            class="txt-default">click</a>
                                        here to &nbsp; <a href="{{ route('customer.login') }}"
                                            class="txt-default">Login</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

    <!-- //END => Content Pages -->
@endsection

@push('scripts')
@endpush
