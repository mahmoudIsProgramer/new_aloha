<?php
$page = 'Login';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!--section start-->
    <section class="login-page section-big-py-space b-g-light bg_section"
        style="background-image: url({{ asset('frontend/') }}/assets/imgs/bg-register.jpg)">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-5 offset-lg-4">
                    <div class="theme-card">
                        <h3 class="text-center">Login</h3>
                        <form action="{{ route('customer.login.post') }}" method="post" class="theme-form">
                            @csrf
                            @method('post')
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>{{ __('site.Email') }}</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="{{ __('site.Email') }}" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>{{ __('site.Password') }} <span class="d-inline-block">Reset
                                            Password</span></label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ __('site.Password') }}" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-normal">{{ __('site.Login') }}</button>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        @lang("site.Don't Have Account?") <a href="go-register.html"
                                            class="txt-default">click</a>
                                        here to &nbsp; <a href="{{ route('customer.register') }}"
                                            class="txt-default">@lang('site.Register Now')</a>
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
