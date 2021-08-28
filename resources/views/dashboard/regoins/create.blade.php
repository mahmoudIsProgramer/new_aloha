@extends('layouts.dashboard.app')
<?php
$page="regoins";
$title=trans('site.regoins');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.regoins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.regoins.index') }}"> @lang('site.regoins')</a></li>
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

                    <form action="{{ route('dashboard.regoins.store') }}"  method="post" enctype="multipart/form-data">

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
                            <label>@lang('site.statee')</label>
                            <select required  autofocus name = 'state_id'  class="form-control"  > 
                                <option value="">@lang('site.statee')</option>
                                @foreach( $states  as $value )
                                <option value="{{$value->id}}"> {{ $value->name }}</option>
                                @endforeach
                                
                            </select>
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


@section('scripts')

@endsection
