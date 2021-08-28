<?php
    $page="Blog Details";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@section('image_url_share'){{$blog->image_path}}@endsection
@section('description_share'){{$blog->description}} @endsection
@section('title_share'){{$blog->title}} @endsection

@extends('layouts.app')

@section('content')

@include('partials.breadCrumb',['page'=>$page,'custome_title'=>$blog->title])

<!-- Blog Details Page Start -->
<section class="inner-page-sec-padding-bottom">
  <div class="container">
    <div class="blog-post post-details mb--50">
      <div class="blog-image"><img src="{{ $blog->image_path  }}" alt=""></div>
      <div class="blog-content mt--30">
        <header>
          <h3 class="blog-title"> {{ $blog->title  }} </h3>
          <div class="post-meta">
            {{-- <span class="post-author">
              <i class="fas fa-user"></i>
              <span class="text-gray">Posted by : </span>
              admin
            </span> --}}
            {{-- <span class="post-separator">|</span> --}}
            <span class="post-date">
              <i class="far fa-calendar-alt"></i>
              {{-- <span class="text-gray"> On : </span> --}}
              {{ $blog->date }}
            </span>
          </div>
        </header>
        <article>
          {!! $blog->description !!}
        </article>
      </div>
    </div>
    <hr>
    <div class="share-block mb--50">
      <h3>@lang('site.Share')</h3>
      <div class="social-links  justify-content-center  mt--10">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="single-social social-rounded"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?text={{$blog->title}}&amp;url={{url()->current()}}" class="single-social social-rounded"><i class="fab fa-twitter"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&description={{$blog->title}}>" class="single-social social-rounded"><i class="fab fa-pinterest-p"></i></a>
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}&amp;title={{$blog->title}}&amp;summary={{$blog->short_description}}" class="single-social social-rounded"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>


  </div>
</section>
<!-- Blog Details Page End -->

@endsection
