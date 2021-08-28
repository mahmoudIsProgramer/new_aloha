@extends('layouts.dashboard.app')
<?php
$page="site_options";
$title=trans('site.site_options');
?>

@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.site_options')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.site_options.index') }}"> @lang('site.site_options')</a></li>
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

                    <form action="{{ route('dashboard.site_options.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div>
                        
                            @php 
                                $language_names= config('translatable.locales_natives') ; 
                            @endphp 

                            <!--  start detaials and description  -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                            @foreach (config('translatable.locales') as $key=>$locale)
                                <li role="presentation" class="@if( $loop->first ) active  @endif"><a href="#{{$locale}}" aria-controls="home" role="tab" data-toggle="tab"> {{ $language_names[$locale] }} </a></li>
                            @endforeach
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @php 
                                    $editor = 0 ; 
                                @endphp
                                @foreach (config('translatable.locales') as $key=>$locale)
                                    <div role="tabpanel" class="tab-pane @if( $loop->first) active  @endif" id="{{$locale}}" >

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.address')</label>
                                            <input  type = 'address'  name="{{ $locale }}[address]" id="" value="{{ old($locale . '.address') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.tit_info')</label>
                                            <input  type = 'tit_info'  name="{{ $locale }}[tit_info]" id="" value="{{ old($locale . '.tit_info') }}" class="form-control"  >
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.tit_video_en')</label>
                                            <input  type = 'tit_video_en'  name="{{ $locale }}[tit_video_en]" id="" value="{{ old($locale . '.tit_video_en') }}" class="form-control"  >
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.tit_video_ar')</label>
                                            <input  type = 'tit_video_ar'  name="{{ $locale }}[tit_video_ar]" id="" value="{{ old($locale . '.tit_video_ar') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.working_time')</label>
                                            <input  type = 'working_time'  name="{{ $locale }}[working_time]" id="" value="{{ old($locale . '.working_time') }}" class="form-control"  >
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_tit')</label>
                                            <input  type = 'seo_tit'  name="{{ $locale }}[seo_tit]" id="" value="{{ old($locale . '.seo_tit') }}" class="form-control"  >
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_key')</label>
                                            <input  type = 'seo_key'  name="{{ $locale }}[seo_key]" id="" value="{{ old($locale . '.seo_key') }}" class="form-control"  >
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_des')</label>
                                            <input  type = 'seo_des'  name="{{ $locale }}[seo_des]" id="" value="{{ old($locale . '.seo_des') }}" class="form-control"  >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_google_analatic')</label>
                                            <input  type = 'seo_google_analatic'  name="{{ $locale }}[seo_google_analatic]" id="" value="{{ old($locale . '.seo_google_analatic') }}" class="form-control"  >
                                        </div>

                                        
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.des_info')</label>
                                            <textarea   name="{{ $locale }}[des_info]" id="" class="form-control" cols="30" rows="5" >{{ old($locale . '.des_info') }}</textarea>
                                        </div>

                                        <div class="  with-border"></div><br>
                                    </div>
                                @endforeach
                            </div>
                            <!--  end detaials and description  -->

                            <div class="container">
                                <div class="row">
                                    
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.num1')</label>
                                            <input  type = 'text'  name="num1" id="" value="{{ old('num1') }}" class="form-control"  >
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.num2')</label>
                                            <input  type = 'text'  name="num2" id="" value="{{ old('num2') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.num3')</label>
                                            <input  type = 'text'  name="num3" id="" value="{{ old('num3') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.email')</label>
                                            <input  type = 'email'  name="email" id="" value="{{ old('email') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.link_video')</label>
                                            <input  type = 'text'  name="link_video" id="" value="{{ old('link_video') }}" class="form-control"  >
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.map')</label>
                                            <textarea  name="map" id="" class="form-control" cols="30" rows="5" ></textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>@lang('site.icon')</label>
                                            <input  type="file" id = 'icon' name="icon" class="form-control image2" enctype="multipart/form-data"  required >
                                        </div>

                                        <!-- <div class="form-group">
                                            <img   src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview2" alt="">
                                        </div> -->

                                        <div class="form-group">
                                            <label>@lang('site.logo')</label>
                                            <input  type="file" id = 'logo' name="logo" class="form-control image2" enctype="multipart/form-data"  required >
                                        </div>

                                        <!-- <div class="form-group">
                                            <img   src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-previe1" alt="">
                                        </div> -->


                                    </div>
                                    
                                </div>
                            </div>
                            
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

@section('js')

@endsection