@extends('layouts.dashboard.app')
<?php
$page="taxes";
$title=trans('site.taxes');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.taxes')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.taxes.index') }}"> @lang('site.taxes')</a></li>
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

                    <form action="{{ route('dashboard.taxes.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @foreach (config('translatable.locales') as $key=>$locale)
                            <div class="form-group">
                                <span class="label label-warning  ">{{$key+1}}  </span>
                            <label>@lang('site.' . $locale . '.name')</label>
                            <input required="required"  type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                            </div>
                            <div class="  with-border"></div><br>
                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control"   required >
                                <option value="1" @if(old('status') == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if(old('status') == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.unit type')</label>
                            <select name='type' class="form-control" required >
                                <option value="">@lang('site.unit type')</option>
                                <option value="value" @if(old('type') == 'value') selected @endif>@lang('site.value')</option>
                                <option value="percent"  @if(old('type') == 'percent') selected @endif>@lang('site.percent')</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <div class="form-group">
                                <input type="text" name="value" required="required"  value="{{old('value')}}" id="" placeholder=" @lang('site.value')" class="form-control"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
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
