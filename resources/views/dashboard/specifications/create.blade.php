@extends('layouts.dashboard.app')
<?php
$page="specifications";
$title=trans('site.specifications');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.specifications')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.specifications.index') }}"> @lang('site.specifications')</a></li>
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

                    <form  id="my-form" action="{{ route('dashboard.specifications.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @foreach (config('translatable.locales') as $key=>$locale)
                            <div class="form-group">
                                    <!-- <span class="label label-warning  ">{{$key+1}}  </span>   -->
                                <label>@lang('site.' . $locale . '.title')</label>
                                <input required="required"  type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                            </div>

                            <div class="  with-border"></div><br>
                        @endforeach
                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name='category_id' id='category_id' class="form-control category_id" required>
                                <option value="">@lang('site.categories')</option>
                                @foreach( $categories as $item )
                                <option value="{{ $item->id}}" @if( old('category_id')==$item->id ) selected
                                @endif>{{ $item->name??"" }}</option>
                                @endforeach
                            </select>
                        </div>

{{--
                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control"   required >
                                <option value="1" @if(old('status') == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if(old('status') == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div> --}}

                        {{-- <div class="form-group">
                            <label>@lang('site.menu')</label>
                            <select name='menu' class="form-control"   required >
                                <option value="1" @if(old('menu') == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if(old('menu') == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div> --}}


                        {{-- <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input  type="file" id='image' name="image"
                                class="form-control image2" enctype="multipart/form-data">

                                <label style="color: #aaa9a9;">255 × 200 pixels</label>
                        </div>

                        <div class="form-group">
                            <img  style="width: 100px"
                                class="img-thumbnail image-preview2" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input  type="file" id='big_image' name="big_image"
                                class="form-control image3" enctype="multipart/form-data">

                                <label style="color: #aaa9a9;">1350 × 300pixels </label>
                        </div>

                        <div class="form-group">
                            <img  style="width: 100px"
                                class="img-thumbnail image-preview3" alt="">
                        </div>--}}

                        <div class="form-group">
                            {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button> --}}
                            <input type='submit' class="btn btn-primary btn_loading" id='btn-submit' value='save'>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
