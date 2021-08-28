@extends('layouts.dashboard.app')
<?php
$page="orders";
$title=trans('site.orders');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>@lang('site.orders')</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
      </li>
      <li><a href="{{ route('dashboard.orders.index') }}"> @lang('site.orders')</a></li>
      <li class="active">@lang('site.edit')</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">@lang('site.edit')</h3>
      </div><!-- end of box header -->
      <div class="box-body">
        <form action="{{ route('dashboard.orders.update',$order->id) }}" method="post" enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('put') }}

          <div class="form-group">
            <div class="form-group">
              <label>@lang('site.status')</label>
              <select name='status' class="form-control" required>
                <option value="">@lang('site.status')</option>
                @foreach (orderStatus() as $status )
                <option value="{{$status}}" @if( $status==$order->status ) selected @endif> {{__('site.'.$status)}}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
              @lang('site.edit')</button>
          </div>
        </form><!-- end of form -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-user"></i> &nbsp;&nbsp; @lang('site.name'):{{$order->customer_name}}
                &nbsp;&nbsp;
                <i class="fa fa-money"></i> &nbsp;&nbsp;
                @lang('site.total'):{{$order->total}}{{getCurrencyBlade()}}
                <small
                  class="pull-right">@lang('site.date_creation'):{{date('d-m-Y', strtotime($order->created_at))  }}</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                <strong>
                  @lang('site.address'):

                  {{$order->customer_city}} ,

                  {{$order->customer_region}},

                  {{$order->customer_address}}

                </strong> <br>
                <strong>
                  @lang('site.phone'):
                  {{$order->customer_phone}}
                </strong>
                <br>

                <strong>
                  @lang('site.email'):
                  {{$order->customer_email}}

                </strong>
                <br>
                <strong>
                  @lang('site.customer_postal_code'):
                  {{$order->customer_postal_code}}

                </strong>
                <br>
                <strong>
                  payment method:
                  {{$order->payment_method}}

                </strong>
                <br>
              </address>
            </div>
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('site.product name')}}</th>
                    <th>@lang('site.price')</th>
                    <th>@lang('site.quantity')</th>
                    <th>@lang('site.color')</th>
                    <th>@lang('site.status')</th>
                    <th>@lang('site.total')</th>
                    <th>@lang('site.options')</th>
                </thead>
                <tbody>
                  @foreach ($order->products as $index=>$product)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->total}}{{getCurrencyBlade()}}</td>
                    <td>{{$product->pivot->qty}}</td>
                    <td>{{$product->pivot->color}}</td>
                    <td>{{$product->pivot->status}}</td>
                    <td>{{ $product->pivot->qty * $product->total }}{{getCurrencyBlade()}}</td>

                    <td>
                      @if( $product->pivot->status =='solid')
                      <a href="{{ route('dashboard.returnProduct',['order'=>$order->id,'product'=>$product->id] ) }}"
                        class="btn btn-danger btn-sm"><i class="fa fa-inof"></i> {{__('site.Return Product')}}</a>
                      @endif
                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">
                @lang('site.date_creation'):{{date('d-m-Y', strtotime($order->created_at))  }}</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th>@lang('site.promocode'):({{$order->promocode }})</th>
                      <td>{{$order->promocode_value }} {{getCurrencyBlade()}} </td>
                    </tr>
                    <tr>
                      <th>@lang('site.Delivery Fees'): ({{$order->city->name}}) </th>
                      <td>{{$order->delivery_fees}} {{getCurrencyBlade()}} </td>
                    </tr>
                    <tr>
                      <th>@lang('site.taxes'):</th>
                      <td>{{$order->taxes}} {{getCurrencyBlade()}} </td>
                    </tr>
                    <tr>
                      <th>@lang('site.total'):</th>
                      <td>{{$order->total}} {{getCurrencyBlade()}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-xs-6">
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- this row will not appear when printing -->
          
          <div class="row no-print">
            <div class="col-xs-12">
              <button onclick="window.print();" class="btn btn-primary"><i
                  class="fa fa-print"></i>@lang('site.print')</button>
            </div>
          </div>
        </section>
      </div><!-- end of box body -->
    </div><!-- end of box -->
  </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
