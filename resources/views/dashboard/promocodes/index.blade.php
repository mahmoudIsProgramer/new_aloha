@extends('layouts.dashboard.app')
<?php
$page="promocodes";
$title=trans('site.promocodes');
$locale = (\App::getLocale() == 'ar')?'ar':'en';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.promocodes')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.promocodes')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.promocodes')
                <small>
                        @lang('site.total_search')
                        ( {{ $promocodes->total() }} )
                </small></h3>
                <form action="{{ route('dashboard.promocodes.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_promocodes'))
                            <a href="{{ route('dashboard.promocodes.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($promocodes->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.title')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.code')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.startDate')</th>
                            <th>@lang('site.endDate')</th>
                            <th>@lang('site.limit')</th>
                            <th>@lang('site.used')</th>
                            <th>@lang('site.type')</th>
                            <th>@lang('site.discount_amount')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $promocodes as $index=>$item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $item->title }}</td>
                            <td> {{ $item->description }}</td>
                            <td> {{ $item->code }}</td>
                            <td> {!! activeColumn($item->status)  !!}</td>
                            <td> {{ date('Y-m-d',strtotime($item->startDate))  }}</td>
                            <td> {{ date('Y-m-d',strtotime($item->endDate)) }}</td>
                            <td> {{ $item->limit }}</td>
                            <td> {{ $item->used }}</td>
                            <td>  @lang('site.'.$item->type)  </td>
                            <td> {{ $item->discount_amount }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_promocodes'))
                                <a href="{{ route('dashboard.promocodes.edit', $item->id) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_promocodes'))
                                <form action="{{ route('dashboard.promocodes.destroy', $item->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
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
                {{ $promocodes->appends(request()->query())->links() }}
                @else
                    <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
