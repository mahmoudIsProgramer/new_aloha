@extends('layouts.dashboard.app')
<?php
$page="backgrounds";
$title=trans('site.backgrounds');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>@lang('site.backgrounds')</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.backgrounds.index') }}"> @lang('site.backgrounds')</a></li>
      <li class="active">@lang('site.add')</li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header">
        <h3 class="box-title">@lang('site.add')</h3>
      </div><!-- end of box header -->
      <div class="box-body">

        @include('partials._errors')

        <form action="{{ route('dashboard.backgrounds.store') }}" method="post" enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('post') }}

          <div class="form-group">
            <label>@lang('site.key')</label>
            <input type="text" id='image' name="key" class="form-control" >
          </div>



          <div class="form-group">
            <label>@lang('site.image')</label>
            <input required="required" type="file" id='image' name="image" class="form-control image2"
              enctype="multipart/form-data">
            {{-- <label style="color: #aaa9a9;">{{size_background()}}</label> --}}

          </div>

          <div class="form-group">
            <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview2"
              alt="">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
          </div>

        </form><!-- end of form -->

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
