@extends('layouts.dashboard.app')

<?php
$page = 'site_options';
$title = trans('site.site_options');
?>

@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.site_options')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.options.index') }}"> @lang('site.site_options')</a></li>
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

                    <form action="{{ route('dashboard.site_options.update', $site_option->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div>
                            <!--  start detaials and description  -->
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
                                            <label>@lang('site.' . $locale . '.address')</label>
                                            <input type='text' name="{{ $locale }}[address]" id=""
                                                value="{{ $site_option->translate($locale)->address ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.copyRights')</label>
                                            <input type='copyRights' name="{{ $locale }}[copyRights]" id=""
                                                value="{{ $site_option->translate($locale)->copyRights ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.working_time')</label>
                                            <input type='working_time' name="{{ $locale }}[working_time]" id=""
                                                value="{{ $site_option->translate($locale)->working_time ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_tit')</label>
                                            <input type='seo_tit' name="{{ $locale }}[seo_tit]" id=""
                                                value="{{ $site_option->translate($locale)->seo_tit ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_key')</label>
                                            <input type='seo_key' name="{{ $locale }}[seo_key]" id=""
                                                value="{{ $site_option->translate($locale)->seo_key ?? '' }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.seo_des')</label>
                                            <input type='seo_des' name="{{ $locale }}[seo_des]" id=""
                                                value="{{ $site_option->translate($locale)->seo_des ?? '' }}"
                                                class="form-control">
                                        </div>

                                        <hr>

                                        <div class="  with-border"></div><br>
                                    </div>
                                @endforeach
                            </div>
                            <!--  end detaials and description  -->

                            <div class="container">

                                <div class="col-md-12">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>@lang('site.num1')</label>
                                            <input type='text' name="num1" id="" value="{{ $site_option->num1 }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.num2')</label>
                                            <input type='text' name="num2" id="" value="{{ $site_option->num2 }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.email')</label>
                                            <input type='email' name="email" id="" value="{{ $site_option->email }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.map')</label>
                                            <textarea name="map" id="" class="form-control" cols="30"
                                                rows="5"> {{ $site_option->map }} </textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>@lang('site.applay_package')</label>
                                            <select name='applay_package' class="form-control">

                                                <option value="">@lang('site.applay_package')</option>
                                                <option value="1" @if (old('applay_package') == '1' || $site_option->applay_package == '1') selected @endif>@lang("site.Active")</option>
                                                <option value="0" @if (old('applay_package') == '0' || $site_option->applay_package == '0') selected @endif>@lang("site.In-Active")</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.minimum_order_option')</label>
                                            <select name='minimum_order_option' class="form-control">
                                                <option value="">@lang('site.minimum_order_option')</option>
                                                <option value="1" @if (old('minimum_order_option') == '1' || $site_option->minimum_order_option == '1') selected @endif>@lang("site.Active")</option>
                                                <option value="0" @if (old('minimum_order_option') == '0' || $site_option->minimum_order_option == '0') selected @endif>@lang("site.In-Active")</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.minimum_order_to_apply_promocode')</label>
                                            <input type='text' name="minimum_order_to_apply_promocode" id=""
                                                value="{{ $site_option->minimum_order_to_apply_promocode }}"
                                                class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.icon')</label>
                                            <input type="file" id='icon' name="icon" class="form-control image2"
                                                enctype="multipart/form-data">
                                        </div>

                                        <div class="form-group">
                                            <img src="{{ $site_option->icon_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview2" alt="">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.logo')</label>
                                            <input type="file" id='logo' name="logo" class="form-control image3"
                                                enctype="multipart/form-data">
                                        </div>

                                        <div class="form-group">
                                            <img src="{{ $site_option->logo_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview3" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>

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
