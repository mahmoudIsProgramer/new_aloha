@extends('layouts.dashboard.app')
<?php
$page = 'sellers';
$title = trans('site.sellers');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.sellers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.sellers')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.sellers')
                        <small>
                            @lang('site.total_search')
                            ( {{ $sellers->total() }} )
                        </small>
                    </h3>

                    <form action="{{ route('dashboard.sellers.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name='status' class="form-control">

                                        <option value="">@lang('site.status')</option>
                                        <option value="1" @if (request()->status == '1') selected @endif>@lang('site.Active')</option>
                                        <option value="0" @if (request()->status == '0') selected @endif>@lang('site.In-Active')</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_sellers'))
                                    <a href="{{ route('dashboard.sellers.create') }}" class="btn btn-primary"><i
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

                    @if ($sellers->count() > 0)

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.full_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.phone')</th>
                                    {{-- <th>@lang('site.user type')</th> --}}
                                    {{-- <th>@lang('site.Total Sale')</th> --}}
                                    <th>@lang('site.options')</th>
                                    <th>@lang('site.status')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sellers as $index => $value)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td> {{ $value->full_name }}</td>
                                        <td> {{ $value->email }}</td>
                                        <td> {{ $value->phone }}</td>
                                        <td>
                                            {{-- <a href="{{ route('dashboard.orders.index', ['customer_id' => $value->id]) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                                @lang('site.orders')
                                            </a>

                                            <a href="{{ route('dashboard.wallet_history.index', ['customer_id' => $value->id]) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                                @lang('site.wallet')
                                            </a> --}}

                                        </td>

                                        @if ($value->status == 1)
                                            <td><span class="label label-success">@lang('site.Active')</span></td>
                                        @else
                                            <td><span class="label label-warning">@lang('site.In-Active')</span></td>
                                        @endif

                                        <td><img src="{{ $value->image_path }}" style="width: 100px;"
                                                class="img-thumbnail" alt="">
                                        </td>
                                        <td>
                                            {{-- start view  user --}}

                                            @if (Auth::user()->hasPermission('read_sellers'))

                                                @include('dashboard.modals.customer',['customer'=>$value])

                                            @else
                                                <a class="active" data-toggle="modal">
                                                    <button class="btn btn-warning btn-xs disabled"><i
                                                            class="fa fa-eye "></i></button>
                                                </a>
                                            @endif
                                            {{-- end view user --}}

                                            @if (auth()->user()->hasPermission('update_sellers'))
                                                <a href="{{ route('dashboard.sellers.edit', $value->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @endif

                                            @if (auth()->user()->hasPermission('delete_sellers'))
                                                <form action="{{ route('dashboard.sellers.destroy', $value->id) }}"
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

                        {{ $sellers->appends(request()->query())->links() }}

                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
