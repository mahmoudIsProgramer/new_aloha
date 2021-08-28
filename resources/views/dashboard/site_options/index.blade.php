@extends('layouts.dashboard.app')
<?php
$page="site_options";
$title=trans('site.site_options');
?>

@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.site_options')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.site_options')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.site_options')
                <small>
                        @lang('site.total_search')
                        ( {{ $site_options->total() }} )
                </small></h3>

                <form action="{{ route('dashboard.site_options.index') }}" method="get">

                    <div class="row">
{{--
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div> --}}

                        {{-- <div class="col-md-4">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>

                            <a href="{{ route('dashboard.site_options.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>

                        </div> --}}

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($site_options->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>Title</th>
                            <th>Description</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ( $site_options as $index=>$item )
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- <td> {!! $item->tit_info !!}</td>
                            <td> {!! $item->des_info !!}</td> --}}

                            <td>
                                <a href="{{ route('dashboard.site_options.edit', $item->id ) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                               

                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table><!-- end of table -->

                {{ $site_options->appends(request()->query())->links() }}

                @else
                    <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
