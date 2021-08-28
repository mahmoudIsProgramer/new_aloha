@extends('layouts.dashboard.app')
<?php
$page="banners";
$title=trans('site.banners');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.banners')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.banners')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.banners')
                    <small>
                            @lang('site.total_search')
                            ( {{ $banners->total() }} )
                       </small></h3>

                {{-- <form action="{{ route('dashboard.banners.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_banners'))
                            <a href="{{ route('dashboard.banners.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>

                    </div>
                </form> --}}

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($banners->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.title')</th>
                            {{-- <th>@lang('site.description')</th> --}}
                            <th>@lang('site.banner location')</th>
                            <th>@lang('site.image')</th>

                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($banners as $index=>$banner)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td> {{ $banner->title }}</td>
                            <td> {{ $banner->bannerLocation }}</td>
                            <td><img src="{{ $banner->image_path }}" style="width: 100px;" class="img-thumbnail" alt="">
                            </td>


                            <td>
                                @if (auth()->user()->hasPermission('update_banners'))
                                <a href="{{ route('dashboard.banners.edit', $banner->id) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                {{-- @if (auth()->user()->hasPermission('delete_banners'))
                                <form action="{{ route('dashboard.banners.destroy', $banner->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger delete btn-sm "><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('site.delete')</button>
                                @endif --}}
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table><!-- end of table -->

                {{ $banners->appends(request()->query())->links() }}

                @else
                    <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>


                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
