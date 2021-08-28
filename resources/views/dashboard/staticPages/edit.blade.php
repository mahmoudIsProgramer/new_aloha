@extends('layouts.dashboard.app')
<?php
$page="staticPages";
$title=trans('site.staticPages');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.staticPages')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.staticPages.index') }}"> @lang('site.staticPages')</a></li>
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

                <form action="{{ route('dashboard.staticPages.update', $staticPage->id) }}" method="post"
                    enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}


                    @foreach (config('translatable.locales') as $key=> $locale)

                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control" required="required"
                            value="{{ $staticPage->translate($locale)->title }}">
                    </div>
                    <div class="form-group">

                        <label>@lang('site.' . $locale . '.short_description')</label>
                        <textarea name="{{ $locale }}[short_description]" id="" class="form-control" cols="30"
                            rows="5">{{ $staticPage->translate($locale)->short_description }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control ckeditor" cols="30"
                            rows="5">{{ $staticPage->translate($locale)->description }}</textarea>

                    </div>




                    @endforeach

                    {{-- <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group">

                        @if( $staticPage->image )
                        <a href="{{url('dashboard/deleteImage/staticPages').'/'.$staticPage->id}}"
                            onclick="return confirm('{{trans('site.confirm_delete')}}')"
                            class="confirm btn btn-danger img-thumbnail image-preview" style="    width: 100px;
                            " title="Delete this item">
                            <i class="fa fa-trash"></i><br>
                            <img src="{{ $staticPage->image_path }}" class="img-thumbnail image-preview" alt="">
                        </a>
                        @endif

                    </div> --}}

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
