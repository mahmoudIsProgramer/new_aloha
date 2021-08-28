@extends('layouts.dashboard.app')
<?php
$page = 'banners';
$title = trans('site.banners');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.banners')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.banners.index') }}"> @lang('site.banners')</a></li>
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

                    <form action="{{ route('dashboard.banners.update', $banner->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        @foreach (config('translatable.locales') as $key => $locale)

                            <div class="form-group">
                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                <label>@lang('site.' . $locale .'.title')</label>
                                <input type="text" name="{{ $locale }}[title]" class="form-control"
                                    value="{{ $banner->translate($locale)->title }}">
                            </div>
                            <div class="form-group">

                                <label>@lang('site.' . $locale . '.description')</label>
                                <textarea name="{{ $locale }}[description]" id="" class="form-control ckeditor" cols="30"
                                    rows="5">{{ $banner->translate($locale)->description }}</textarea>

                            </div>

                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.link')</label>
                            <input type="text" value="{{ old('link') ?? $banner->link }}" name="link"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control">

                                <option value="">@lang('site.status')</option>
                                <option value="1" @if (old('status') == '1' || $banner->status == '1') selected @endif>@lang("site.Active")
                                </option>
                                <option value="0" @if (old('status') == '0' || $banner->status == '0') selected @endif>@lang("site.In-Active")
                                </option>

                            </select>
                        </div>


                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $banner->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
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
