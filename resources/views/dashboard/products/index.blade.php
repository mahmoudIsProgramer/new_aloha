@extends('layouts.dashboard.app')

<?php
    $page="products";
    $title=trans('site.products');
    $locale=app()->getLocale();
?>

@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

  <section class="content-header">

    <h1>@lang('site.products')</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
      </li>
      <li class="active">@lang('site.products')</li>
    </ol>
  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products')
          <small>
            @lang('site.total_search')
            ( {{ $products->total() }} )
          </small></h3>

        <form action="{{ route('dashboard.products.index') }}" method="get">

          <div class="row">

            <div class="col-md-4">
              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                value="{{ request()->search }}">
            </div>

            <div class="col-md-4">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                @lang('site.search') </button>
              {{--  start filter button  --}}
              <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-search"> </i> @lang('site.filter')
              </a>
              {{-- end  filter button  --}}

              @if (auth()->user()->hasPermission('create_products'))
              <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                @lang('site.add')</a>
              @else
              <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                @lang('site.add')</a>
              @endif
            </div>

          </div>
          @include("dashboard/products/filteration")

          {{--  end propeties filtration  --}}
        </form><!-- end of form  filteration -->

      </div><!-- end of box header -->



      <div class="box-body">

        @if ($products->count() > 0)

        <table class="table table-hover">

          <thead>
            <tr>
              <th>#</th>
              <th>@lang('site.' . $locale . '.name')</th>
              <th>@lang('site.category')</th>
              <th>@lang('site.brand')</th>
              <th>@lang('site.attributes')</th>
              <th class='text-center'>@lang('site.specifications')</th>
              <th>@lang('site.status')</th>
              <th>@lang('site.image')</th>
              <th>@lang('site.action')</th>
            </tr>
          </thead>

          <tbody>

            @foreach ( $products as $index=> $value)
            <tr>
              <td>{{  $index + 10 }}</td>
              <td>{{  $value->name }}</td>
              <td>{{  $value->category->name }} <br>{{  $value->subcategory->name }} <br>  {{   $value->subsubcategory->name }}</td>
              <td>{{  $value->brand->name??"" }}</td>
              <td>
                @include('dashboard.products.attributes')
              </td>
              <td>
                  <a href="{{route('dashboard.products.details.index',$value->id)}}"
                      class="btn btn-success btn-xs">@lang('site.specifications')
                  </a>
                  <a href="{{route('dashboard.products.sellers.index',$value->id)}}"
                      class="btn btn-success btn-xs">@lang('site.sellers')
                  </a>
              </td>
              <td>{!! activeColumn($value->status) !!}</td>


              <td><img src="{{ $value->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
              <td>

                @include('dashboard.products.modal_info')

                @if (auth()->user()->hasPermission('update_products'))
                <a href="{{ route('dashboard.products.copy_product', $value->id) }}" class="btn btn-info btn-sm"><i
                    class="fa fa-edit"></i> @lang('site.copy') </a>
                <a href="{{ route('dashboard.products.edit', $value->id) }}" class="btn btn-info btn-sm"><i
                    class="fa fa-edit"></i> @lang('site.edit') </a>
                @if( $value->approved == '0')
                <a href="{{ route('dashboard.products.approve',$value->id) }}" class="btn btn-success btn-sm"><i
                    class="fa fa-edit"></i> @lang('site.approve')</a>
                @endif
                @else
                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                  @lang('site.edit')</a>
                @endif

                @if (auth()->user()->hasPermission('delete_products'))

                <a data-toggle="modal" href="#status-trip{{ $value->id }}" class="btn btn-danger btn-sm"><i
                    class="fa fa-trash"></i> @lang('site.delete') </a>

                <div class="modal fade" id="status-trip{{ $value->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">

                      </div>
                      <p style='margin:auto;width:80%'> @lang('site.Are you sure you want to delete this property')
                        {{$value->name}}</p>
                      <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-primary left" type="button"><i
                            class="fa fa-close"></i> @lang('site.close')</button>
                        <a data-toggle="modal" href="{{ route('dashboard.product_delete', $value->id) }}"
                          class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('site.delete') </a>
                      </div>
                    </div>
                  </div>
                </div>

                @else
                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                  @lang('site.delete')</button>
                @endif
                <!-- end delete  -->
              </td>

            </tr>
            @endforeach

          </tbody>

        </table><!-- end of table -->

        {{-- {{ $products->links() }} --}}
        {{ $products->appends(request()->query())->links() }}

        @else
        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
        @endif

      </div><!-- end of box body -->


    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
