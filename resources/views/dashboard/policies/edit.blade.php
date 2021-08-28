@extends('layouts.dashboard.app')
<?php
$page="policies";
$title=trans('site.policies');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.policies')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.policies.index') }}"> @lang('site.policies')</a></li>
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

                    <form action="{{ route('dashboard.policies.update', $policy->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        @foreach (config('translatable.locales') as $key=> $locale)

                                <div class="form-group">
                                        <span class="label label-warning  ">{{$key+1}}  </span>
                                    <label>@lang('site.' . $locale .'.title')</label>
                                    <input   type="text" name="{{ $locale }}[title]" class="form-control"  required="required"  value="{{ $policy->translate($locale)->title }}">
                                </div>

                                <div class="form-group">

                                    <label>@lang('site.' . $locale . '.description')</label>
                                <textarea    name="{{ $locale }}[description]" id="" class="form-control ckeditor" required="required"   cols="30" rows="5">{{ $policy->translate($locale)->description }}</textarea>

                                </div>

                        @endforeach
<!--
                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select required name = 'active'  class="form-control"  >
                                <option value="1" @if( $policy->active == '1' ) selected @endif > @lang('site.Active')</option>
                                <option value="0" @if( $policy->active == '0' ) selected @endif > @lang('site.In-Active')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div> -->

<!--
                        <div class="form-group">
                            <img src="{{ $policy->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div> -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
