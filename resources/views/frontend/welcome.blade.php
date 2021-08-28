<?php
$page = 'home';
?>
@extends('layouts.app')

@section('title_page')
    @lang('site.home')
@endsection

@section('content')

    {{-- slider --}}
    @include('frontend.components.homePage.slider')

    {{-- hotDeal --}}
    @include('frontend.components.homePage.hotDeal')

    {{-- newArrival --}}
    @include('frontend.components.homePage.newArrival')

    {{-- recommendedProducts --}}
    @include('frontend.components.homePage.recommendedProducts')

    {{-- categories --}}
    @include('frontend.components.homePage.categories')

    {{-- banners --}}
    @include('frontend.components.homePage.banners')

    {{-- brands --}}
    @include('frontend.components.homePage.brands')

@endsection
@push('scripts')

@endpush
