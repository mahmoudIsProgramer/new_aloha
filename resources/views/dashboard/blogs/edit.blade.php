@extends('layouts.dashboard.app')
<?php
$page="blogs";
$title=trans('site.blogs');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.blogs')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.blogs.index') }}"> @lang('site.blogs')</a></li>
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

                <form action="{{ route('dashboard.blogs.update', $blogs->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $key=> $locale)

                        <div class="form-group">
                                <span class="label label-warning  ">{{$key+1}}  </span>
                            <label>@lang('site.' . $locale .'.title')</label>
                            <input   type="text" name="{{ $locale }}[title]" class="form-control"  required="required"  value="{{ $blogs->translate($locale)->title }}">
                        </div>

                        <div class="form-group">

                            <label>@lang('site.' . $locale . '.short_description')</label>
                        <textarea    name="{{ $locale }}[short_description]" id="" class="form-control" required="required"   cols="30" rows="5">{{ $blogs->translate($locale)->short_description }}</textarea>

                        </div>


                        <div class="form-group">

                            <label>@lang('site.' . $locale . '.description')</label>
                        <textarea    name="{{ $locale }}[description]" id="" class="form-control ckeditor" required="required"   cols="30" rows="5">{{ $blogs->translate($locale)->description }}</textarea>

                        </div>

                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <!-- <div class="form-group">
                        <label>@lang('site.featured product')</label>
                        <select name='featured' class="form-control" required autofocus>
                            <option value="">@lang('site.featured product')</option>

                            <option value="featured"    @if($blogs->featured == "featured") selected @endif>@lang("site.featured")</option>
                            <option value="non featured" @if($blogs->featured == "non featured") selected @endif>@lang("site.non featured")</option>

                        </select>
                    </div> -->

                    <div class="form-group">
                        <img src="{{ $blogs->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                            @lang('site.edit')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
