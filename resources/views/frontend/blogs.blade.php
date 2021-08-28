<?php
    $page="Blogs";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])

<!-- Blog Page Start -->
<section class="inner-page-sec-padding-bottom space-db--30">
  <div class="container">
    <div class="row space-db-lg--60 space-db--30">

      @forelse ($blogs as $value)
      <div class="col-lg-4 col-md-6 mb-lg--60 mb--30">
        <div class="blog-card card-style-grid">
          <a href="{{ route('blogDetails', ['blog'=> $value->id ]) }}" class="image d-block">
            <img src="{{ $value->image_path }}" alt="">
          </a>
          <div class="card-content">
            <h3 class="title"><a href="{{ route('blogDetails', ['blog'=> $value->id ]) }}">{{ $value->title }}</a></h3>
            <p class="post-meta"><span> {{ $value->date }} </span></p>
            <article>
              <p>{{ $value->short_description }}
              </p>
              <a href="{{ route('blogDetails', ['blog'=> $value->id ]) }}" class="blog-link"> @lang('site.More Details ...')</a>
            </article>
          </div>
        </div>
      </div>
      @empty
      @include('partials.no_data_found')
      @endforelse
      <!-- Pagination -->
    </div>
    <div>
      {{ $blogs->appends(request()->query())->links() }}
    </div>
  </div>
</section>
<!-- Blog Page End -->


@endsection
