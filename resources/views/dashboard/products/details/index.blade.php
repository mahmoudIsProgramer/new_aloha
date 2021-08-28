@extends('layouts.dashboard.app')

<?php
$page = 'details';
$title = trans('site.details');
?>

@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.details')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>
                        @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index', ['search' => $product->name]) }}"><i
                            class="fa fa-dashboard"></i> {{ $product->name }}</a></li>

                <li class="active">@lang('site.details')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.details')
                        <small>
                            @lang('site.total_search')
                            ( {{ $details->total() }} )
                        </small>
                    </h3>

                    <form action="{{ route('dashboard.products.details.index', ['product' => $product->id]) }}"
                        method="get">
                        <div class="row">
                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($details->count() > 0)

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th class='text-center'>#</th>
                                    <th class='text-center'>@lang('site.specification')</th>

                                    @foreach (config('translatable.locales') as $key => $locale)
                                        <th class='text-center'>@lang('site.' . $locale .'.title')</th>
                                    @endforeach

                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($details as $index => $item)
                                    <form
                                        action="{{ route('dashboard.products.details.update', ['product' => $product->id, 'detail' => $item->id]) }}"
                                        method="post" enctype="multipart/form-data">

                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->specification->name }}</td>

                                            @foreach (config('translatable.locales') as $key => $locale)
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="{{ $locale }}[name]"
                                                            class="form-control" required="required"
                                                            value="{{ $item->translate($locale)->name ?? '' }}">
                                                    </div>
                                                </td>
                                            @endforeach

                                            <td>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $details->appends(request()->query())->links() }}

                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
