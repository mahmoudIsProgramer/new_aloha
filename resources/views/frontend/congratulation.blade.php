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

            <i class="fa fa-check" style="color: #4CAF50;"></i>
            <h4> @lang('site.Congratulations') </h4>

            {{-- <a  class = "btn btn-success mt-3" href ="{{route('home')}}">{{__('site.Home')}}</a> --}}
            <h2 style="
                margin-top: 1rem;
                font-size: 1.5rem;
                font-weight: 400;
                border: 1px solid #ddd;
                display: inline-block;
                padding: 1.5rem;
                box-shadow: 0 5px 10px #ddd;">
            

            @if ($msg=session('msg'))
                {!!$msg!!}
            @endif

            </h2>

        </div>

    </div>
</section>
<!-- Section ends -->


@endsection
