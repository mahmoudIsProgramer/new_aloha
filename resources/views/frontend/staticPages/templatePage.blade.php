<?php
$page = $staticPages->title;
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page,'custome_title'=>$page])

    <!--section start-->
    <section class="about-page section-big-py-space">
        <div class="container">
            <h3 class="mb-3">{{ $staticPages->title }} </h3>
            {!! $staticPages->description !!}
        </div>
    </section>
    <!--section end-->
@endsection
