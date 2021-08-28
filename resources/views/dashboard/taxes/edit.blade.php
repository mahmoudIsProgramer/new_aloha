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
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.taxes.index') }}"> @lang('site.taxes')</a></li>
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

                <form action="{{ route('dashboard.taxes.update', $tax->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $key=> $locale)

                        <div class="form-group">
                                <span class="label label-warning  ">{{$key+1}}  </span>
                            <label>@lang('site.' . $locale .'.name')</label>
                            <input   type="text" name="{{ $locale }}[name]" class="form-control"  required="required"  value="{{ $tax->translate($locale)->name }}">
                        </div>

                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.status')</label>
                        <select name='status' class="form-control"   required >
                            <option value="1" @if( (old('status') == '1')||$tax->status=='1') selected @endif>@lang('site.Active')</option>
                            <option value="0" @if( (old('status') == '0')||$tax->status=='0') selected @endif>@lang('site.In-Active')</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.unit type')</label>
                        <select name='type' class="form-control" required >
                            <option value="">@lang('site.unit type')</option>
                            <option value="value" @if(old('type') == 'value'|| $tax->type=='value') selected @endif>@lang('site.value')</option>
                            <option value="percent"  @if(old('type') == 'percent'|| $tax->type=='percent') selected @endif>@lang('site.percent')</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.value')</label>
                        <input required="required"  type="text" name="value" class="form-control" value="{{ old('value')??$tax->value }}" required  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
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
