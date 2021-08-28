<?php
    $page="categories";
?>
@section('title_page')
{{__('site.'.$page)}}
@endsection

@extends('layouts.app')

@section('content')
@include('partials.breadCrumb',['page'=>$page])

<!--=================================
    Categories
    ===================================== -->
<main class="inner-page-sec-padding-bottom index-premium">
  <section class="pt--30 section-margin section-catgs">
    <div class="container">
      <div class="row">
        @forelse ($categories as $value)
        <div class="col-lg-3 col-md-3 mb-lg--60 mb--30">
          <div class="blog-card card-style-grid">
            <a href="{{ route('products', ['category_id'=>$value->id]) }}" class="image d-block">
              <img src="{{ $value->image_path }}" alt="">
            </a>
            <div class="card-content px-2">
              <h3 class="title"><a href="{{ route('products', ['category_id'=>$value->id]) }}">{{ $value->title }}</a>
              </h3>
            </div>
          </div>
        </div>
        @empty
        @include('partials.no_data_found')
        @endforelse
      </div>
      <div>
        {{ $categories->appends(request()->query())->links() }}
      </div>
  </section>
</main>

@endsection
