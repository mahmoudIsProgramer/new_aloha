@extends('layouts.dashboard.app')
<?php
$page = 'specifications';
$title = trans('site.specifications');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.specifications')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.specifications.index') }}"> @lang('site.specifications')</a></li>
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

                    <form action="{{ route('dashboard.specifications.update', $specification->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        @foreach (config('translatable.locales') as $key => $locale)

                            <div class="form-group">
                                <!-- <span class="label label-warning  ">{{ $key + 1 }}  </span>   -->
                                <label>@lang('site.' . $locale .'.title')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" required="required"
                                    value="{{ $specification->translate($locale)->name ?? '' }}">
                            </div>

                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name='category_id' id='category_id' class="form-control category_id" required>
                                <option value="">@lang('site.categories')</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if (old('category_id', $specification->category_id) == $item->id) selected @endif>{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control"   required >
                                <option value="1" @if (old('status') == '1' || $specification->status == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if (old('status') == '0' || $specification->status == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                            <label style="color: #aaa9a9;">255 ?? 200 pixels</label>
                        </div>

                        <div class="form-group">
                            <img src="{{ $specification->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.big_image')</label>
                            <input type="file" name="big_image" class="form-control image2">
                            <label style="color: #aaa9a9;">1350 ?? 300 pixels</label>
                        </div>

                        <div class="form-group">
                            <img src="{{ $specification->big_image_path }}" style="width: 100px" class="img-thumbnail image-preview2" alt="">
                        </div> --}}


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
