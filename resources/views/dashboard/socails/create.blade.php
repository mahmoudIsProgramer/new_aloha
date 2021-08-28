@extends('layouts.dashboard.app')
<?php
$page="superabout";
$title=trans('site.superabout');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.superabout')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
            <li><a href="{{ route('dashboard.superabout.index') }}"> {{$title}}</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>
    {{-- {{dd($roles)}} --}}
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.superabout.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label>@lang('site.tit_en')</label>
                        <input type="text" name="tit_en" class="form-control" value="{{ old('tit_en') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.des_en')</label>
                        <textarea name="des_en" id="" class="form-control" cols="2" rows="2">{{old('des_en')}}</textarea>
                    </div>

                    <div class="form-group">
                            <label>@lang('site.tit_ar')</label>
                            <input type="text" name="tit_ar" class="form-control" value="{{ old('tit_ar') }}">
                        </div>
              
    
                        <div class="form-group">
                            <label>@lang('site.des_ar')</label>
                            <textarea name="des_ar" id="" class="form-control" cols="2" rows="2">{{old('des_ar')}}</textarea>
                        </div>

                        
                            <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="img" class="form-control image">
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview"
                                        alt="">
                                </div>

                                
                            <div class="form-group">
                                <label>@lang('site.image')2</label>
                                <input type="file" name="img2" class="form-control imageTwo">
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-previewtwo"
                                    alt="">
                            </div>
                            <div class="form-group" style="display: none;">
                                <input type="hidden" name="created_by" class="form-control" value="{{ Auth::user()->email }}">
{{--                                 <input type="hidden" name="updated_by" class="form-control" value="{{ Auth::user()->email }}"> --}}
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
