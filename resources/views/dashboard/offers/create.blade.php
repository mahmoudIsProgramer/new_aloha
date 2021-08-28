@extends('layouts.dashboard.app')
<?php
$page="offers";
$title=trans('site.offers');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.offers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.offers.index') }}"> @lang('site.offers')</a></li>
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

                    <form action="{{ route('dashboard.offers.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="col-md-12">
                            <h2>{{__('site.Please Select One At Least From Categoires Or Sucategoires Or Brands')}}</h2>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.percent')</label>
                                    <input required="required"  type="text" name="percent" class="form-control" value="{{old('percent')}}"    oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control"   required >
                                        <option value="1" @if(old('status') == '1') selected @endif>@lang('site.Active')</option>
                                        <option value="0" @if(old('status') == '0') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.Category')</label>
                                    <select name='category_id' class="form-control city_id"  >
                                    <option value="">@lang('site.Category')</option>
                                    @foreach($categories as $city )
                                        <option value="{{$city->id}}" @if(old('category_id') == $city->id ) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.Subcategory')</label>
                                    <select name='subcategory_id' class="form-control city_id"  >
                                    <option value="">@lang('site.Subcategory')</option>
                                    @foreach($subcategories as $city )
                                        <option value="{{$city->id}}" @if(old('subcategory_id') == $city->id ) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.Brand')</label>
                                    <select name='brand_id' class="form-control city_id"  >
                                    <option value="">@lang('site.Brand')</option>
                                    @foreach($brands as $city )
                                        <option value="{{$city->id}}" @if(old('brand_id') == $city->id ) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add') </button>
                                </div>
                            </div>


                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
