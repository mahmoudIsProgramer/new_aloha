<?php
    $page="Payment Status";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])


<!-- section start -->
<section class="section-big-py-space blog-page ratio2_3">
    <div class="custom-container">

        <div class="page-congrats">

            <i class="fa fa-times" style="color:red;"></i>
            <h4>Payment Failed </h4>
            <a  class = "btn btn-success" href ="{{route('home')}}">{{__('site.Home')}}</a>

        </div>

    </div>
</section>
<!-- Section ends -->


@endsection
