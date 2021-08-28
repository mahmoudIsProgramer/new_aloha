@extends('layouts.dashboard.app')
<?php
$page = 'brands';
$title = trans('site.brands');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.brands')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.brands.index') }}"> @lang('site.brands')</a></li>
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

                    <form action="{{ route('dashboard.brands.update', $brand->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        @foreach (config('translatable.locales') as $key => $locale)

                            <div class="form-group">
                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                <label>@lang('site.' . $locale .'.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" required="required"
                                    value="{{ @$brand->translate($locale)->name }}">
                            </div>

                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" id='image' name="image" class="form-control image2"
                                enctype="multipart/form-data">

                        </div>

                        <div class="form-group">
                            <img src="{{ $brand->image_path }}" style="width: 100px" class="img-thumbnail image-preview2"
                                alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control" required>
                                <option value="1" @if (old('status') == '1' || $brand->status == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if (old('status') == '0' || $brand->status == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>

                </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

    </div><!-- end of box -->

    </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')


    <script type="text/javascript">
        $(function() {
            $("#buttonAdd").bind("click", function() {
                var div = $("<div />");
                div.html(GenerateTextbox(""));
                $("#TextBoxContainer").append(div);
            });

            $("body").on("click", ".remove", function() {
                $(this).closest("div").remove();
            });
        });

        function GenerateTextbox() {

            return '<div class="form-group"> <input name = "bundle[]" type="text" value = "" required autofocus placeholder = "bundle name" /> ' +
                '<input name = "price[]" type="text" value = "" required autofocus  placeholder= "price"  /> ' +
                '<input type="button" value="Remove" class="remove"  /></div>';
        }
    </script>
@endsection
