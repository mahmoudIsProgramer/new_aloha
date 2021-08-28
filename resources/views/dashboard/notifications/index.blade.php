@extends('layouts.dashboard.app')
<?php
$page="notifications";
$title=trans('site.notifications');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.notifications')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.notifications.index') }}"> @lang('site.notifications')</a></li>
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

                    <form action="{{ route('dashboard.notifications.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('site.title')}}</label>
                                <input name="title" required value="{{old('title')}}" type="text" class="form-control"
                                    placeholder="{{__('site.title')}}" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('site.Message')}}</label>
                                <input name="message" required value="{{old('message')}}" type="text" class="form-control"
                                    placeholder="{{__('site.Message')}}" >
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('site.link')}}</label>
                                <input name="link" required value="{{old('link')}}" type="text" class="form-control"
                                    placeholder="{{__('site.link')}}" >
                            </div>
                        </div> --}}
                        
                        <div class="col-md-6">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                            </div>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
