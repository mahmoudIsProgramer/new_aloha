@extends('layouts.dashboard.app')
<?php
$page="background";
$title=trans('site.background');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

  <section class="content-header">

    <h1>@lang('site.background')</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.backgrounds.index') }}"> @lang('site.background')</a></li>
      <li class="active">@lang('site.edit')</li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header">
        <h3 class="box-title"> @lang('site.edit') </h3>
      </div><!-- end of box header -->

      <div class="box-body">
        @include('partials._errors')

        <form action="{{ route('dashboard.backgrounds.update', $background->id) }}" method="post"
          enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('put') }}

          <div class="form-group">
            <label>@lang('site.key')</label>
            <input type="text" id='image' value="{{ $background->key }}" name="key" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label>@lang('site.image')</label>
            <input type="file" id='image' name="image" class="form-control image2" enctype="multipart/form-data">
            {{-- <label style="color: #aaa9a9;">{{size_background()}}</label> --}}

          </div>

          <div class="form-group">
            <img src="{{ $background->image_path }}" style="width: 100px" class="img-thumbnail image-preview2" alt="">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
          </div>

        </form><!-- end of form -->

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
