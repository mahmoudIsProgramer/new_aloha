<?php
    $page="Faqs";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])


<!--section start-->
<section class="faq-section section-big-py-space bg-light">
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
        <div class="accordion theme-accordion" id="accordionExample">
            @foreach ( $faqs as $key=>$item  )

            <div class="card">
                <div class="card-header" id="headingOne{{$loop->iteration}}">
                    <h5 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#collapseOne{{$loop->iteration}}" aria-expanded="true" >{{$item->question}}</button></h5>
                </div>
                <div id="collapseOne{{$loop->iteration}}" class="collapse @if($loop->first) show @endif " data-parent="#accordionExample">
                    <div class="card-body">
                    <p>{{$item->answer}}</p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        </div>
    </div>
    </div>
</section>
<!--Section ends-->



@endsection
