@extends('layouts.dashboard.app')
<?php
$page = 'storages';
$title = trans('site.storages');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.storages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.storages')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.storages')
                        <small>
                            @lang('site.total_search')
                            ( {{ $storages->total() }} )
                        </small>
                    </h3>

                    <form action="{{ route('dashboard.storages.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_rams'))
                                    <a href="{{ route('dashboard.storages.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($storages->count() > 0)

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th class='text-center'>#</th>
                                    <th class='text-center'>@lang('site.name')</th>
                                    {{-- {{-- <th class='text-center'>@lang('site.image')</th> --}}
                                    {{-- <th class='text-center'>@lang('site.status')</th> --}}
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($storages as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td> {{ $item->title }}</td>
                                        {{-- <td><img src="{{ $item->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td> --}}

                                        <td>
                                            @if (auth()->user()->hasPermission('update_rams'))
                                                <a href="{{ route('dashboard.storages.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_rams'))
                                                <form action="{{ route('dashboard.storages.destroy', $item->id) }}"
                                                    method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                            class="fa fa-trash"></i>
                                                        @lang('site.delete')</button>
                                                </form><!-- end of form -->
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                                    @lang('site.delete')</button>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $storages->appends(request()->query())->links() }}

                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>

                    @endif

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection