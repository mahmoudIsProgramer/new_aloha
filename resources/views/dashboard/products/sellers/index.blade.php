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
                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-dashboard"></i>
                        @lang('site.products')</a>
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
                            {{-- ( {{ $sellers->total() }} ) --}}
                        </small>
                    </h3>


                    <div class="row">



                        <div class="col-md-4">

                            @if (auth()->user()->hasPermission('create_products'))
                                <a href="{{ route('dashboard.products.sellers.create', ['product' => $product]) }}"
                                    class="btn btn-primary"><i class="fa fa-plus"></i>
                                    @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                    @lang('site.add')</a>
                            @endif
                        </div>

                    </div>


                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($sellers->count() > 0)

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.seller')</th>
                                    <th>@lang('site.selling_price')</th>
                                    <th>@lang('site.discount')</th>
                                    <th>@lang('site.stock')</th>
                                    <th>@lang('site.sku')</th>
                                    <th>@lang('site.status')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($product->sellers as $index => $value)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $value->full_name }}</td>
                                        <td>{{ $value->pivot->selling_price }}</td>
                                        <td>{{ $value->pivot->discount }}</td>
                                        <td>{{ $value->pivot->stock }}</td>
                                        <td>{{ $value->pivot->sku }}</td>
                                        <td>{!! activeColumn($value->pivot->status) !!}</td>
                                        <td>

                                            @if (auth()->user()->hasPermission('update_products'))
                                                <a href="{{ route('dashboard.products.sellers.edit', ['product' => $product->id, 'seller' => $value->id]) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                    @lang('site.edit') </a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @endif

                                            @if (auth()->user()->hasPermission('delete_products'))
                                                <form
                                                    action="{{ route('dashboard.products.sellers.destroy', ['product' => $product->id, 'seller' => $value->id]) }}"
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

                        {{-- {{ $sellers->appends(request()->query())->links() }} --}}

                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                    @endif

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
