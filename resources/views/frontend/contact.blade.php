<?php
$page = 'Contact Us';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])


    <!--section start-->
    <section class="contact-page section-big-py-space b-g-light bg_section"
        style="background-image: url({{ asset('frontend/') }}/assets/imgs/bg-register.jpg)">
        <div class="custom-container">
            <div class="row section-big-pb-space">
                <div class="col-xl-6 offset-xl-3">
                    <h3 class="text-center mb-3">Get in touch</h3>
                    <form  action="{{ route('contactPost') }}" class="theme-form" method="post">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.Full Name') <span class="required">*</span></label>
                                    <input name="name" type="text" id="con_name" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="review">@lang('site.phone')</label>
                                    <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.Email Address') <span class="required">*</span></label>
                                    <input name="email" type="email" id="con_email" name="email" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label>@lang('site.message')</label>
                                    <textarea class="form-control" placeholder="@lang('site.message')" name="message"
                                        rows="2"></textarea>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-normal" type="submit">@lang('site.send') </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 map">
                    <div class="theme-card">
                        {!! $siteOption->map !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->


@endsection
