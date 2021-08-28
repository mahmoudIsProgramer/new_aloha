@extends('layouts.dashboard.app')
<?php
$page="ads";
$title=trans('site.ads');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

  <section class="content-header">

    <h1>@lang('site.ads')</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.ads.index') }}"> @lang('site.ads')</a></li>
      <li class="active">@lang('site.edit')</li>
    </ol>
  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header">
        <h3 class="box-title">@lang('site.edit')</h3>
      </div><!-- end of box header -->

      <div class="box-body">

        @include('partials._errors')

        <form action="{{ route('dashboard.ads.update', $add->id) }}" method="post" enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('put') }}

          <div class="form-group">
            <label>@lang('site.script')</label>
            <textarea name="script" id="" class="form-control" cols="30" rows="5">{{ $add->script }}</textarea>
          </div>

          <div class="form-group">
            <label>@lang('site.images')</label>
            <input type="file" name="images[]" multiple class="form-control" enctype="multipart/form-data">
            @foreach ( $images as $imgs )
            <a href="{{url('dashboard/deleteImage/ads').'/'.$imgs['id']}}"
              onclick="return confirm('{{trans('site.confirm_delete')}}')"
              class="confirm btn btn-danger img-thumbnail image-preview" style="width: 100px;
                                        " title="Delete this item">
              <i class="fa fa-trash"></i><br>
              <img src="{{$imgs->image_path}}" class="img-thumbnail image-preview" alt="">
            </a>
            @endforeach
          </div>

          <div class="form-group">
            <label>@lang('site.type')</label>
            <select name='type' class="form-control" required>

              <option value="">@lang('site.type')</option>
              <option value="image" @if($add->type == "image") selected @endif>@lang("image")</option>
              <option value="script" @if($add->type == "script") selected @endif>@lang("script")</option>

            </select>
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
