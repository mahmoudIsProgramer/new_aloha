@extends('layouts.dashboard.app')

<?php
$page = 'storages';
$title = trans('site.storages');
?>

@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.storages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.storages.index') }}"> @lang('site.storages')</a></li>
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

                    <form action="{{ route('dashboard.storages.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties)
                                <li role="presentation" class="@if ($loop->first) active @endif"><a href="#{{ $locale }}"
                                        aria-controls="home" role="tab" data-toggle="tab"> {{ $properties['native'] }}
                                    </a></li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            @foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties)
                                <div role="tabpanel" class="tab-pane @if ($loop->first) active @endif" id="{{ $locale }}">

                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.title')</label>
                                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                                            value="{{ old($locale . '.title') }}" required>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>@lang('site.' . $locale . '.short_description')</label>
                                        <textarea name="{{ $locale }}[short_description]" id="" class="form-control" cols="30" rows="5"
                                      required>{{ old($locale . '.short_description') }}</textarea>

                                    </div> --}}

                                    <div class="  with-border"></div><br>
                                </div>
                            @endforeach

                        </div>

                        {{-- <div class="form-group">
                          <label>@lang('site.image')</label>
                          <input type="file" id='image' name="image" class="form-control image2" enctype="multipart/form-data">
                        </div>

                        <div class="form-group">
                          <img style="width: 100px" class="img-thumbnail image-preview2" alt="">
                        </div> --}}

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
